<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRequestConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
	
    public $recipient;
    public $title;
    public $id;
    public $image = 'linkn-cerebro.png';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $recipient, String $title, Int $id)
    {
        $this->recipient = $recipient;
        $this->title = $title;
        $this->id = $id;
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
