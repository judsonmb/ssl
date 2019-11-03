<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use RequestModel;
use Illuminate\Support\Facades\Storage;

class UpdateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $request;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, RequestModel $request, String $subject, String $body)
    {
        $this->user = $user;
        $this->request = $request;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        if($this->request->response_file != "")
        {
            return $this
                ->subject($this->subject)
                ->attach(storage_path("app\\public\\files\\".$this->request->response_file))
                ->view("emails.updaterequest");
        }
        else
        {
            return $this
                ->subject($this->subject)
                ->view("emails.updaterequest");
        }
    }
}
