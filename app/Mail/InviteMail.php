<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invite_info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite_info)
    {
        $this->invite_info = $invite_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation For Registration')->markdown('emails.invite_mail');
    }
}
