<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use RequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestModel;
    public $request;
    public $subject;
    public $body;
	public $requester;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RequestModel $requestModel, $request)
    {
        $this->requestModel = $requestModel;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
		$this->subject = 
			(($this->requestModel->status != $this->request->input('status')) && 
				($this->request->input('status') == 'done')) ? 'Sua solicitação foi feita!' : 'O status da sua solicitação foi atualizado';
	
		$this->body = "O status da sua solicitação foi atualizado para <h2>" . $this->request->input('status') . "</h2>";
		
		$this->body .= "Detalhes:<br>";
            
		$this->body .= "Projeto: " . $this->requestModel->project->name . "<br>";
		
		$technician = User::find($this->request->input('technician_id'));
		
        $technicianName = ($technician == null) ? "Ainda não definido" : $technician->name;
	
		$this->body .= "Técnico Responsável: " . $technicianName . "<br>";
	
		$this->body .= "Tipo: " . $this->request->input('type') . "<br>";
		
		$this->body .= "Prioridade: " . $this->request->input('priority') . "<br>";
		
		if($this->request->input('deadline') != null){
			$deadline = new \DateTime($this->request->input('deadline'));
			$deadline = $deadline->format('d/m/Y');
		}else{
			$deadline = "Ainda não definido";
		}
	
		$this->body .= "Prazo: " . $deadline . "<br>";
	
		$this->body .= "Pontos de Função: " . $this->request->input('function_points') . "<br>";
		
		$this->requester = $this->requestModel->user->name;
		
		if($this->request->file('file') != null)
			 $this->attach(storage_path("app\\files\\".$this->request->file('file')->getClientOriginalName()));
		 
		return $this
                ->subject($this->subject)
                ->view("emails.updaterequest");
    }
}
