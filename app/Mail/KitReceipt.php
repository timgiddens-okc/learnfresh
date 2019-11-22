<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KitReceipt extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order,$grandTotal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$grandTotal)
    {
        $this->order = $order;
        $this->grandTotal = $grandTotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Your Receipt")->markdown('emails.receipt');
    }
}
