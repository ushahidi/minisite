<?php

namespace Modules\Minisite\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSiteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $block;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($block, $email, $message)
    {
        $this->block = $block;
        $this->email = $email;
        $this->message = $message;
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
                ->view('minisite::email')->with(['text' => $this->message, 'email' => $this->email]);
    }
}
