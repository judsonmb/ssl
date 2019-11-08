<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\File;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\UploadedFile $file, int $request_id)
    {
		$fileModel = new File();
		
		$exists = File::where('name', 'LIKE', '%'.$file->getClientOriginalName().'%')->count();
		
		$fileModel->name = (!$exists) ? $file->getClientOriginalName() : '('. $exists . ')' . $file->getClientOriginalName();
		
		$fileModel->request_id = $request_id;
		
		Storage::put('/files/'.$fileModel->name, file_get_contents($file));
		
		$fileModel->save();
		
		return $fileModel->name;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
		Storage::delete('files/'.$name);
    }
}
