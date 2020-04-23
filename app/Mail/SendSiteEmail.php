<?php

namespace App\Mail;

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
    public function __construct($block, $email, $message, $communityUrl, $communityName)
    {
        $this->block = $block;
        $this->email = $email;
        $this->message = $message;
        $this->communityUrl = $communityUrl;
        $this->communityName = $communityName;
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
                ->view('minisite::email')
                ->subject('Message from your community site on Mahallah.org')
                ->with(
                    [
                        'text' => $this->message,
                        'email' => $this->email,
                        'communityUrl' => $this->communityUrl,
                        'communityName' => $this->communityName
                    ]
                );
    }
}
