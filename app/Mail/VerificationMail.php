<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $userName)
    {
        $this->title = $title;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userName = $this->userName;
        return $this->view('emails.verification_mail', compact('userName'))
                    ->subject($this->title);
    }
}
