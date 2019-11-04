<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Institution;

use Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
		$users = User::with('institution')->where('active', 1)->orderby('name')->paginate(10);
		
        return view(Auth::user()->type.'.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions = Institution::orderby('initials')->get();
		
		return view(Auth::user()->type.'.users-create', compact('institutions')); 
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

        User::create($request->all());

        return redirect()->route('users.index');
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
       $user = User::find($id);
	   
	   $user->load('institution');
	   
	   $institutions = Institution::orderby('initials')->get();

       return view(Auth::user()->type.'.users-edit', compact('user', 'institutions')); 
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
        $this->validate($request, $id);

        $user = User::find($id);
        
		$user->update($request->all());
        
		return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
		
        $user->active = '0';
		
        $user->save();
		
        return redirect()->route('users.index');
    }

    public function editPassword()
    {
        $layout = (Auth::user()->type = 'admin') ? 'layouts.app-admin' : 'layouts.app';
		
        return view('users-edit-password', compact('layout'));
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
			
        ]);
            
        $user = User::find(Auth::user()->id);
		
        $user->password = bcrypt($request->input('password'));
		
        $user->save();

        return redirect('home');
    }

    public function validate(Request $request, $id = null, Array $rules = null, Array $messages = null, Array $customAttributes = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => "required|email|max:255|unique:users,email,$id",
            'type' => 'required',
			'institution_id' => 'required',
        ]);
    }

}
