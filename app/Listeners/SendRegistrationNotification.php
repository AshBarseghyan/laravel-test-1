<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Mail;

class SendRegistrationNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // Send registration email notification
        Mail::to($event->user->email)->queue(new RegistrationEmail($event->user));
    }
}
