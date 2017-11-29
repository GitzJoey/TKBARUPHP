<?php

namespace App\Mail\Auth;

use LaravelLocalization;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(LaravelLocalization::getCurrentLocale() == 'id' ? 'Aktifkan Akun Anda':'Activate Your Account')
            ->markdown('emails.auth.activationemail')
            ->with('token', $this->user->activation_token);
    }
}
