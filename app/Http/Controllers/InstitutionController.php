<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       $institutions = Institution::orderBy('initials')->paginate(10);
	   
	   return view('institutions', compact('institutions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutions-create');
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

        $institution = new Institution();
		
        $institution->initials = strtoupper($request->input('initials'));
		
        $institution->name = $request->input('name');
		
        $institution->save();
		
        return redirect()->route('institutions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $institution = Institution::find($id);

       return view('institutions-edit', compact('institution')); 
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

        $institution = Institution::find($id);
		
        $institution->initials = strtoupper($request->input('initials'));
		
        $institution->name = $request->input('name');
		
        $institution->save();
		
        return redirect()->route('institutions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Institution::destroy($id);
		
        return redirect()->route('institutions.index');
    }
	
	public function validate(Request $request, Array $rules = null, Array $messages = null, Array $customAttributes = null)
    {
        $validatedData = $request->validate([
            'initials' => 'required|string|min:2|max:255',
            'name' => 'required|string|min:2|max:255',
        ]);
    }
}
