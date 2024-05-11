<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $admin;

    /**
     * Create a new message instance.
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Get the message envelope.
     */
/*     public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resetta la tua password',
        );
    } */

    public function build()
    {
        return $this->view('email.admin.password')
                    ->with(['admin' => $this->admin])
                    ->subject('Resetta la tua password');
    }
    /**
     * Get the message content definition.
     */
  /*   public function content(): Content
    {
        return new Content(
            view: 'email.admin.password',
        );
    }
 */
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
  /*   public function attachments(): array
    {
        return [];
    } */
}
