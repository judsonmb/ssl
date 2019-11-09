<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestMessageMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $userName;
	public $requestTitle;
	public $requestId;
	public $messageMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $requestTitle, $requestId, $message)
    {
        $this->userName = $userName;
        $this->requestTitle = $requestTitle;
        $this->requestId = $requestId;
        $this->messageMail = $message;
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
