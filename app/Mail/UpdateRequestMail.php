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

    public $recipient;
    public $title;
    public $status;
    public $file;
    public $id;
    public $image = 'linkn-cerebro.png';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $recipient, String $title, 
    String $status, $file, Int $id)
    {
        $this->recipient = $recipient;
        $this->title = $title;
        $this->status = $status;
        $this->file = $file;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
		if($this->file != null)
			 $this->attach(storage_path("app/files/".$this->file->getClientOriginalName()));
		 
		return $this
                ->subject('Sua solicitação foi atualizada')
                ->view("emails.updaterequest");
    }
}
