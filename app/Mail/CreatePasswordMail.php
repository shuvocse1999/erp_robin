<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $userId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $userId)
    {
        $this->token = $token;
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.createPassword') // Specify the correct view file
        ->with(['token' => $this->token,'userId'=>$this->userId])
            ->subject('Create Your Password'); // Set the subject for the email
    }
}
