<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\UserVerificationMail;
use App\Models\UserVerification;
use App\Notifications\UserVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendEmailUserVerificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $token = Str::random(60);
        $data = [
            'user_id' => $event->user->id,
            'token'   => $token
        ];
        UserVerification::create($data);
        //Mail::to($event->user->email)->send(new UserVerificationMail($event->user, $token));
        $event->user->notify(new UserVerificationNotification($token));
    }
}
