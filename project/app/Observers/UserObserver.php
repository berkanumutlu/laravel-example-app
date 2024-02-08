<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserVerification;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserVerificationNotification;
use App\Traits\Loggable;
use Illuminate\Support\Str;

class UserObserver
{
    use Loggable;

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
        $this->log('create', $user, $user->id, $user->toArray());
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->wasChanged('password')) {
            $user->notify(new UserResetPasswordNotification($user));
        }
        if (!$user->wasChanged('deleted_at')) {
            $this->updateLog($user);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->log('delete', $user, $user->id, $user->toArray());
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $this->log('restore', $user, $user->id, $user->toArray());
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->log('force_delete', $user, $user->id, $user->toArray());
    }
}
