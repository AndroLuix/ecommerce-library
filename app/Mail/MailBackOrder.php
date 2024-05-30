<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailBackOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $order;
   
    public function __construct($order)
    {
        //
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('email.admin.back-order')
                    ->with(['order' => $this->order, 
                    'product' => $this->order->product, 
                    'costumer' => $this->order->user])
                    ->subject("Ordine Annullato ". $this->order->product->title." - 
                    ". config('app.name') );
    }

    /**
     * Get the message content definition.
     */
  

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
 
}
