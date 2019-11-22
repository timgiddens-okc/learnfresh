<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPurchaseOrder extends Mailable
{
    use Queueable, SerializesModels;

	public $po;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($po)
    {
        $this->po = $po;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Purchase Order #" . $this->po->purchase_order_number)->view('emails.po');
    }
}
