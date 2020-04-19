<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInviteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $message, $token)
    {
        $this->email = $email;
        $this->message = $message;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
            $this
                ->view('minisite::invite-email')->with(
                    ['text' => $this->message, 'email' => $this->email, 'token' => $this->token]
                );
    }
}
