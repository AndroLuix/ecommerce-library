<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailSendOrder extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->view('email.admin.send-order')
                    ->with(['order' => $this->order, 
                    'product' => $this->order->product, 
                    'costumer' => $this->order->user])
                    ->subject(config('app.name')." - Ordine Iviato! ". $this->order->product->title );
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
