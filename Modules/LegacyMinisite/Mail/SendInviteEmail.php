<?php

namespace Modules\Minisite\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInviteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $message;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $message, $link)
    {
        $this->email = $email;
        $this->message = $message;
        $this->link = $link;
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
                ->view('communitymanager::members.invite-email')->with(['text' => $this->message, 'email' => $this->email, 'link' => $link]);
    }
}
