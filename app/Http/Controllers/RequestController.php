<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RequestModel;

use App\Http\Controllers\RequestHistoricController;

use App\RequestHistoric;

use App\User;

use App\Institution;

use App\Project;

use App\File;

use Auth;

use Mail;

use App\Mail\NewRequestMail;

use App\Mail\UpdateRequestMail;

use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		switch(Auth::user()->type){

            case 'admin':
                $requests = RequestModel::orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
                break;
				
            case 'main requester':
                $requests = RequestModel::wherehas('user', function($query){
                    $query->where('type', '!=', 'admin');
                })->orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
                break;
				
            case 'requester':
				$requests = RequestModel::wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
                break;
        }

        return view('requests-'.Auth::user()->type, compact('requests'));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        switch(Auth::user()->type)
		{

            case 'admin':
                $projects = Project::orderby('name')->get();
                break;
				
            case 'main requester':
                //quero todos os projetos das instituições de usuários que não são admins
                $users = User::where('type','admin')->get()->pluck('institution_id');
                $projects = Project::where('institution_id', '!=', $users)->orderby('name')->get();
                break;
				
            case 'requester':
                $projects = Project::where('institution_id', '=', Auth::user()->institution_id)->orderby('name')->get();
                break;
        }
		
		return view('requests-create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|min:2|max:255',
            'description' => 'required',
        ]);

        $requestModel = new RequestModel();
		
        $requestModel->user_id = Auth::user()->id;
		
        $requestModel->project_id = $request->input('project_id');
		
        $requestModel->title = $request->input('title');
		
        $requestModel->description = $request->input('description');
		
		$requestModel->save();
		
        if($request->file('file') != null)
        {
            $file = $request->file('file');
			
            $fileName = $file->getClientOriginalName();
			
            Storage::put('files/'.$fileName, file_get_contents($file));
			
            $fileModel = new File();
			
			$fileModel->name = $fileName;
			
			$fileModel->request_id = $requestModel->id;
			
			$fileModel->save();
        }
        
        $requestHistoric = new RequestHistoricController();
		
        $requestHistoric->store($requestModel->id, Auth::user()->id);
        
		$fileName = ($request->file('file') != null) ? $request->file('file')->getClientOriginalName() : '';
		
        Mail::to('judsonmelobandeira@gmail.com')->send(new NewRequestMail(Auth::user()->name, $fileName, $request->input('title'), $request->input('description')));

        return redirect()->route('requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = RequestModel::find($id);
        $historics = RequestHistoric::where('request_id', $id)->orderBy('action_datetime')->get();

        $request->load('user');
        $request->load('project');
        $request->load('technician');

        $historics->load('user');

        return response()->json(array(
             'request' => $request,
             'historics' => $historics
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = RequestModel::find($id);

        $request->load('user');

		$technicians = User::where('type', 'admin')->orderBy('name')->get();

        return view('requests-edit', compact('request', 'technicians'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$requestModel = RequestModel::find($id);
		
		$requestModel->load('user');
		
        $requestModel->load('project');
		
		if($requestModel->status != $request->input('status'))
        {   
            if($request->input('status') == 'done')
            { 
                $validatedData = $request->validate([
                    'type' => 'required',
                    'priority' => 'required',
                    'deadline' => 'required',
                    'technician_id' => 'required',
                    'function_points' => 'required',
                ]);
				
				$actualDate = new \DateTime();
                
				$doneDate = new \DateTime($request->input('deadline'));
                
				$requestModel->delivered = ($doneDate >= $actualDate) ? 'on time' : 'late'; 
 
			} 
			
		}	
		
		$requestModel->type = $request->input('type');
		
		$requestModel->priority = $request->input('priority');	

		$requestModel->deadline = $request->input('deadline');	

		$requestModel->technician_id = $request->input('technician_id');	
		
		$requestModel->function_points = $request->input('function_points');	
		
		$requestHistoric = new RequestHistoricController();
		
        $requestHistoric->update($requestModel, $request);
		
		if($request->file('file') != null)
        {
            $file = $request->file('file');
			
            $fileName = $file->getClientOriginalName();
			
            Storage::put('files/'.$fileName, file_get_contents($file));
			
            $fileModel = new File();
			
			$fileModel->name = $fileName;
			
			$fileModel->request_id = $requestModel->id;
			
			$fileModel->save();
        }
		
		$requestModel->save();
		
		Mail::to($requestModel->user->email)->send(new UpdateRequestMail($requestModel, $request));

        return redirect()->route('requests.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
