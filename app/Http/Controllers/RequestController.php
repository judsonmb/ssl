<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RequestModel;

use App\Http\Controllers\RequestHistoricController;
use App\Http\Controllers\FileController;

use App\RequestHistoric;

use App\User;

use App\Institution;

use App\Project;

use App\File;

use Auth;

use Mail;

use App\Mail\NewRequestMail;

use App\Mail\UpdateRequestMail;

use App\Mail\SendRequestConfirmMail;

use App\Mail\ResponsibleTechnicianMail;

use App\Mail\RequestMessageMail;

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

            case 'administrador':
						
                $requests = RequestModel::where('status', '!=', 'feita')->orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
				
                break;
				
            case 'parceiro':
                $requests = RequestModel::where('status', '!=', 'feita')->wherehas('user', function($query){
                    $query->where('type', '!=', 'administrador');
                })->orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
                break;
				
            case 'solicitante':
				$institution = Auth::user()->institution_id;
				$requests = RequestModel::where('status', '!=', 'feita')->wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderby('status')->orderBy('deadline', 'asc')->orderby('created_at')->paginate(10);
                break;
        }

        return view(Auth::user()->type.'.requests', compact('requests'));
		
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
            case 'administrador':
                $users = User::orderby('name')->get();
                $projects = Project::orderby('name')->get();
                return view('administrador.requests-create', compact('projects', 'users'));
                break;
				
            case 'parceiro':
                $users = User::where('type','administrador')->get()->pluck('institution_id');
                $projects = Project::where('institution_id', '!=', $users)->orderby('name')->get();
                break;
				
            case 'solicitante':
                $projects = Project::where('institution_id', '=', Auth::user()->institution_id)->orderby('name')->get();
                break;
        }
		
		return view(Auth::user()->type.'.requests-create', compact('projects'));
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
		
        $requestModel->user_id = ($request->user_id == null) ? Auth::user()->id : $request->user_id;
		
        $requestModel->project_id = $request->input('project_id');

        $requestModel->created_out = '0';
		
        $requestModel->title = $request->input('title');
		
        $requestModel->description = $request->input('description');
		
		$requestModel->save();
		
		if($request->file('file') != null)
        {
			$file = new FileController();
			
			$file->store($request->file('file'), $requestModel->id);
        }
        
        $requestHistoric = new RequestHistoricController();
		
        $requestHistoric->store($requestModel->id, Auth::user()->id);
        
		$fileName = ($request->file('file') != null) ? $request->file('file')->getClientOriginalName() : '';
		
        Mail::to('contato@linkn.com.br')->send(new NewRequestMail(Auth::user()->name, $fileName, $request->input('title'), $request->input('description'), $requestModel->id));

        Mail::to('andre.lima@eyeduc.com.br')->send(new NewRequestMail(Auth::user()->name, $fileName, $request->input('title'), $request->input('description'), $requestModel->id));

        Mail::to('andreducap@gmail.com')->send(new NewRequestMail(Auth::user()->name, $fileName, $request->input('title'), $request->input('description'), $requestModel->id));

		Mail::to(Auth::user()->email)->send(new SendRequestConfirmMail(Auth::user()->name, $request->input('title'), $requestModel->id));

        return redirect()->route('requests.index')->with('status', 'Solicitação enviada com sucesso!');
    }

    public function apiStore(Request $request)
    {
        // $validatedData = $request->validate([
        //     'project_id' => 'required',
        //     'title' => 'required|string|min:2|max:255',
        //     'description' => 'required',
        // ]);
            
        $user = User::where('email', $request->email)->first();

        if(empty($user))
        {
            $user = new User();
            
            $user->name = $request->name;

            $user->email = $request->email;

            $user->type = 'solicitante';

            $project = Project::find($request->project_id)->first();

            $user->institution_id = $project->institution_id;

            $user->save();
        }

        $requestModel = new RequestModel();

        $requestModel->user_id = $user->id;

        $requestModel->project_id = $request->project_id;

        $requestModel->created_out = '1';

        $requestModel->title = $request->title;

        $requestModel->description = $request->description;

        $requestModel->save();

        if($request->file('file') != null)
        {
			$file = new FileController();
			
			$file->store($request->file('file'), $requestModel->id);
        }

        $requestHistoric = new RequestHistoricController();
		
        $requestHistoric->store($requestModel->id, $user->id);

        $fileName = ($request->file('file') != null) ? $request->file('file')->getClientOriginalName() : '';

        Mail::to('contato@linkn.com.br')->send(new NewRequestMail($user->name, $fileName, $request->title, $request->description, $requestModel->id));

        Mail::to('andre.lima@eyeduc.com.br')->send(new NewRequestMail($user->name, $fileName, $request->title, $request->description, $requestModel->id));

        Mail::to('andreducap@gmail.com')->send(new NewRequestMail($user->name, $fileName, $request->title, $request->description, $requestModel->id));
       
        Mail::to($request->email)->send(new SendRequestConfirmMail($user->name, $request->title, $requestModel->id));

        return response('Feito!', 200);
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
        
		$historics = RequestHistoric::where('request_id', $id)->orderBy('created_at', 'desc')->get();

        $files = File::where('request_id', $id)->get();
		
		$request->load('user');
		
        $request->load('project');
		
        $request->load('technician');

        $historics->load('user');
		
        return view('requests-details', compact('request', 'historics', 'files'));
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
		
        $request->load('technician');

		$technicians = User::where('type', 'administrador')->orderBy('name')->get();

        return view(Auth::user()->type.'.requests-edit', compact('request', 'technicians'));
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
		
		$requestModel->load('technician');
		
        $requestModel->load('project');
		
		if($request->file('file') != null)
        {
			$file = new FileController();
			
			$file->store($request->file('file'), $requestModel->id);
        }
		
		if($requestModel->status != $request->input('status'))
        {  		
            if($request->input('status') == 'feita')
            { 
                $validatedData = $request->validate([
                    'type' => 'required',
                    'priority' => 'required',
                    'deadline' => 'required',
                    'technician_id' => 'required',
                    'function_points' => 'required',
                ]);
				
				$actualDate = new \Date();
                
                $deadlineDate = new \Date($requestModel->deadline);
                
				$requestModel->delivered = ($deadlineDate >= $actualDate) ? 'dentro do prazo' : 'atrasado'; 
			
			} 
			
            Mail::to($requestModel->user->email)
            ->send(new UpdateRequestMail($requestModel->user->name, $requestModel->title, 
            $requestModel->status, $request->file('file'), $requestModel->id));

            Mail::to('andre.lima@eyeduc.com.br')
            ->send(new UpdateRequestMail($requestModel->user->name, $requestModel->title, 
            $requestModel->status, $request->file('file'), $requestModel->id));

            Mail::to('andreducap@gmail.com')
            ->send(new UpdateRequestMail($requestModel->user->name, $requestModel->title, 
            $requestModel->status, $request->file('file'), $requestModel->id));

		}	
		
		$requestHistoric = new RequestHistoricController();
		
        $requestHistoric->update($requestModel, $request);
		
		$requestModel->type = $request->input('type');
		
        $requestModel->priority = $request->input('priority');

        if($requestModel->status == 'bloqueada' && $requestModel->status != $request->input('status'))
        {
            $deadline = new \DateTime('+1 day'); 
            $deadline = $deadline->format('Y-m-d');
        }else{
            $deadline = $request->input('deadline');
        }

        $requestModel->deadline = $deadline;
		
		$requestModel->status = $request->input('status');	
		
		if(($requestModel->technician_id != $request->input('technician_id')) and ($request->input('technician_id') != null)){
			
			$technician = User::find($request->input('technician_id'));
		
			Mail::to($technician->email)->send(new ResponsibleTechnicianMail($technician->name, $requestModel->title, $requestModel->id));
			
		}

		$requestModel->technician_id = $request->input('technician_id');	
		
        $requestModel->function_points = $request->input('function_points');
		
		$requestModel->save();
		
        return redirect()->route('requests.index')->with('status', 'Solicitação atualizada com sucesso!');
    }
	
	public function sendMessage(Request $request, $id){
		
		$validatedData = $request->validate([
			'message' => 'required|max:255',
		]);
		
		$message = $request->input('message');
		
		$requestModel = RequestModel::with(['user', 'technician'])->find($id);
		
		$r = new RequestHistoricController();
		
		$r->store($id, Auth::user()->id, 'enviou uma mensagem: ' . $message, 'message');
		
		if(Auth::user()->type == 'administrador'){
			
			$email = $requestModel->user->email;
			$name = $requestModel->user->name;
		
		}else{
			
			$name = $requestModel->technician->name;
			
			if($requestModel->technician != null){
				
				$email = $requestModel->technician->email;
				
			}else{
				
				$email = 'contato@linkn.com.br';
			}
		}
		
		Mail::to($email)->send(new RequestMessageMail($name, $requestModel->title, $message, $requestModel->id));
        
        Mail::to('andre.lima@eyeduc.com.br')->send(new RequestMessageMail($name, $requestModel->title, $message, $requestModel->id));

        Mail::to('andreducap@gmail.com')->send(new RequestMessageMail($name, $requestModel->title, $message, $requestModel->id));

		return redirect()->route('requests.show', $id)->with('status', 'Mensagem enviada com sucesso!');
		
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$request = RequestModel::find($id);
		
		$files = File::where('request_id', $id)->get();
		
		if($files != null)
		{
			$fileController = new FileController();
		
			foreach($files as $f)
			{
				$fileController->destroy($f->name);
			}
		}
		
        RequestModel::destroy($id);
	
		return redirect()->route('requests.index')->with('status', 'Solicitação excluída com sucesso!');
    }

}
