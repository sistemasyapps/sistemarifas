<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\Order;

class PurchaseApproved extends Mailable
{
    use Queueable, SerializesModels;
    private Order $order;
    private $numbers;
    private $logo;
    //public $from;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $numbers, $logo)
    {
        $this->order = $order;
        $this->numbers = $numbers;
        $this->logo = $logo;
        //$this->from = "email";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                env('MAIL_FROM_ADDRESS', 'hello@rifasvinotinto.com'), 
                env('MAIL_FROM_NAME', 'RifasVinotinto')
            ),
            subject: '[RifasVinotinto.com] Compra Aprobada - #'.$this->order->id,
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
                "logo" => $this->logo,
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
