<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserActivationEmail;

use App\User;

use Mail;
use Exception;
use LaravelLocalization;
use App\Mail\Auth\ActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationEmail
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserActivationEmail  $event
     * @return void
     */
    public function handle(UserActivationEmail $event)
    {
        try {
            Mail::to($event->user->email)->send(new ActivationEmail($event->user));
        } catch (Exception $e) {

        }
    }
}
