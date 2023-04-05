<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class PlacedOrder extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order;
    public $items;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Invoice',
        );
    }

    public function build()
    {
        return $this->subject('Order Invoice')
                    ->markdown('emails.placedOrder');
    }
}
