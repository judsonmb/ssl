<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRequestConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $userName;
	public $requestId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $requestId)
    {
        $this->userName = $userName;
        $this->requestId = $requestId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
			->subject('Sua solicitação foi enviada')
			->view('emails.sendrequestconfirm');
    }
}
