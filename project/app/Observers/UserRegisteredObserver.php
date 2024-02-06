<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserVerification;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserVerificationNotification;
use Illuminate\Support\Str;

class UserRegisteredObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $token = Str::random(60);
        $data = [
            'user_id' => $user->id,
            'token'   => $token
        ];
        UserVerification::create($data);
        $user->notify(new UserVerificationNotification($token));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->wasChanged('password')) {
            $user->notify(new UserResetPasswordNotification($user));
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
