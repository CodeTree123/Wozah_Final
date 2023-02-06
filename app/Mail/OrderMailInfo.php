<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMailInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $order_info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_info)
    {
        $this->order_info = $order_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Mail Information')
                    ->markdown('emails.order_info');
    }
}
