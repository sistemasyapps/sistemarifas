<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class PurchaseApproved extends Mailable
{
    use Queueable, SerializesModels;
    private Order $order;
    private $numbers;
    //public $from;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $numbers)
    {
        $this->order = $order;
        $this->numbers = $numbers;
        //$this->from = "email";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Ganaconandreaaular.com] Compra Aprobada - #'.$this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase-approved',
            with: [
		"order"=>$this->order,
		"numbers"=>$this->numbers,
		"from"=>"email"
		]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
