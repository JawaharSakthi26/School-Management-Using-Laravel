<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $user;
    protected $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
    
    public function build()
    {
        return $this
            ->from('preskool@gmail.com', 'PreSkool')
            ->subject('Welcome to PreSkool!')
            ->view('email.mailTemplate')
            ->with(['user' => $this->user, 'password' => $this->password]); 
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
