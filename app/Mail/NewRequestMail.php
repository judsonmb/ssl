<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use RequestModel;

class NewRequestMail extends Mailable
{
    use Queueable, SerializesModels;

	public $userName;
    public $fileName;
	public $requestTitle;
	public $requestDescription;
	public $requestId;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $userName, String $fileName, String $requestTitle, String $requestDescription, $requestId)
    {
        $this->userName = $userName;
        $this->fileName = $fileName;
		$this->requestTitle = $requestTitle;
		$this->requestDescription = $requestDescription;
		$this->requestId = $requestId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {		
        if($this->fileName != "")
        {
            return $this
                ->subject($this->userName . ' enviou uma solicitação.')
                ->attach(storage_path("app/files/".$this->fileName))
                ->view('emails.newrequest');
        }else
        {
            return $this
                ->subject($this->userName . ' enviou uma solicitação.')
                ->view('emails.newrequest');
        }
        
    }
}
