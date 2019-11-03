<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use RequestModel;

use App\RequestHistoric;

use App\User;

use Auth;

class RequestHistoricController extends Controller
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
     * @param  \Illuminate\Http\Request  $request id and user id
     */
    public function store($requestId, $userId)
    {
        $requestHistoric = new RequestHistoric();
        $requestHistoric->request_id = $requestId;
        $requestHistoric->user_id = $userId;
        $requestHistoric->save();
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
    public function update(RequestModel $requestModel, Request $request)
    {
        $technician = ($requestModel->technician_id != $request->input('editRequestTechnician')) ? User::find( $request->input('editRequestTechnician')) : null;
        $technicianMessage = ($technician == null) ? "" : " responsible technician to " . $technician->name . ";"; 
        
        $message = "updated";
        $message .= ($requestModel->status != $request->input('editRequestStatus')) ? " the status to ".$request->input('editRequestStatus')." ;" : "";
        $message .= ($requestModel->technician_id != $request->input('editRequestTechnician')) ? $technicianMessage : "";
        $message .= ($requestModel->type != $request->input('editRequestType')) ? " the type to ".$request->input('editRequestType').";" : "";
        $message .= ($requestModel->priority != $request->input('editRequestPriority')) ? " the priority to ".$request->input('editRequestPriority').";" : "";
        $message .= ($requestModel->deadline != $request->input('editRequestDeadline')) ? " the deadline to ".date_format(new \DateTime($request->input('editRequestDeadline')), 'd/m/Y').";" : "";
        $message .= ($requestModel->function_points != $request->input('editRequestFunctionPoints')) ? " the function points to ".$request->input('editRequestFunctionPoints').";" : "";
        $message .= ($request->file('file') != null) ? " added a response file;" : "";

        $action = ($request->input('editRequestStatus') == 'done') ? 'completed' : 'update';

        $requestHistoric = new RequestHistoric();
        $requestHistoric->request_id = $requestModel->id;
        $requestHistoric->user_id = $request->input('actualUser');
        $requestHistoric->message = $message;
        $requestHistoric->action = $action;
        $requestHistoric->save();

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
