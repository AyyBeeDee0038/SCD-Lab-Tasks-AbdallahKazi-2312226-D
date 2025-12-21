<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    // Pass the user data into the mail class
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // We will create this view in Step 6
        return $this->subject('Verify Your Email Address')
                    ->view('emails.verify'); 
    }
}