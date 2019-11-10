<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestMessageMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $recipient;
	public $title;    
	public $msg;
    public $id;
    public $image = 'linkn-cerebro.png';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $recipient, String $title, String $msg, Int $id)
    {
        $this->recipient = $recipient;
        $this->title = $title;
        $this->msg = $msg;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {		
        return $this->subject('Uma mensagem foi enviada')
			->view('emails.requestmessage');
    }
}
