<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponsibleTechnicianMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $requestTitle;
    public $requestId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $requestTitle, $requestId)
    {
        $this->userName = $userName;
        $this->requestTitle = $requestTitle;
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
			->subject('Uma solicitação foi atribuída para você')
			->view('emails.responsibletechnician');
    }
}
