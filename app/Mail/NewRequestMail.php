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

	public $sender;
    public $file;
	public $title;
	public $description;
    public $id;
    public $image = 'linkn-cerebro.png';

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $sender, String $file, String $title, 
    String $description, Int $id)
    {
        $this->sender = $sender;
        $this->file = $file;
		$this->title = $title;
		$this->description = $description;
        $this->id = $id;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {		
        if($this->file != "")
        {
            return $this
                ->subject($this->sender . ' enviou uma solicitação.')
                ->attach(storage_path("app/files/".$this->file))
                ->view('emails.newrequest');
        }else
        {
            return $this
                ->subject($this->sender . ' enviou uma solicitação.')
                ->view('emails.newrequest');
        }
        
    }
}
