<?php

namespace App\Jobs;

use App\Mail\RegisteredMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $password;
    protected $emailTemplate;

    public function __construct(User $user, $password, $emailTemplate)
    {
        $this->user = $user;
        $this->password = $password;
        $this->emailTemplate = $emailTemplate;
    }

    public function handle()
    {
        $email = new RegisteredMail($this->user, $this->password, $this->emailTemplate);
        Mail::to($this->user->email)->send($email);
    }
}
