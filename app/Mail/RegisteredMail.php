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
    protected $emailTemplate;

    public function __construct(User $user, $password, $emailTemplate)
    {
        $this->user = $user;
        $this->password = $password;
        $this->emailTemplate = $emailTemplate;
    }
    
    public function build()
    {
        return $this
            ->from('preskool@gmail.com', 'PreSkool')
            ->subject('Welcome to PreSkool!')
            ->view($this->emailTemplate)
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
