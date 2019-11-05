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
        $message = "atualizou a solicitação:";
		
        $message .= ($requestModel->status != $request->input('status')) 
			? " o status para ".$request->input('status')." ;" 
			: "";
			
        $technician = ($requestModel->technician_id != $request->input('technician_id')) 
			? User::find( $request->input('technician_id')) 
			: null;
			
        $message .= ($technician == null) 
			? "" 
			: " o técnico responsável para " . $technician->name . ";"; 
			
        $message .= ($requestModel->type != $request->input('type')) 
			? " o tipo para ".$request->input('type').";" 
			: "";
		
        $message .= ($requestModel->priority != $request->input('priority')) 
			? " a prioridade para ".$request->input('priority').";" : "";

		
        $message .= ($requestModel->deadline != $request->input('deadline')) 
			? " o prazo para ".date_format(new \DateTime($request->input('deadline')), 'd/m/Y').";" 
			: "";
			
        $message .= ($requestModel->function_points != $request->input('function_points')) 
			? " os pontos de função para ".$request->input('function_points').";" 
			: "";
		
        $message .= ($request->file('file') != null) 
			? " anexou um arquivo;" 
			: "";

        $action = ($request->input('status') == 'feita') 
			? 'completed' 
			: 'update';

        $requestHistoric = new RequestHistoric();
		
        $requestHistoric->request_id = $requestModel->id;
		
        $requestHistoric->user_id = Auth::user()->id;
		
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
