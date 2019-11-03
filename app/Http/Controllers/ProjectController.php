<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Institution;

use App\Project;

use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projects = Project::orderBy('name')->paginate(10);
		
        return view('/projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions = Institution::orderby('initials')->get();
		
		return view('projects-create', compact('institutions')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $project = Project::find($id);
	   
	   $project->load('institution');
	   
	   $institutions = Institution::orderby('initials')->get();

       return view('projects-edit', compact('project', 'institutions')); 
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
        $this->validate($request);

        $project = Project::find($id);
        
		$project->update($request->all());
        
		return redirect()->route('projects.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);
		
        return redirect()->route('projects.index');
    }

    public function validate(Request $request, Array $rules = null, Array $messages = null, Array $customAttributes = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'institution_id' => 'required',
        ]);
    }
}
