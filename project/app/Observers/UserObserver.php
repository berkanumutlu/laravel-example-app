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
        if ($user->wasChanged('password') && isset(\request()->reset_password)) {
            $this->updateLog($user, 'reset_password_changed');
            $user->notify(new UserResetPasswordNotification($user));
            $this->log('password_changed_send_mail', $user, $user->id, ['to' => $user->email]);
        } elseif ($user->wasChanged('password') && isset(\request()->new_password)) {
            //TODO: Şifreniz değiştirildi diye notify gönderilebilir.
            $this->updateLog($user, 'change_password');
        } elseif (!$user->wasChanged('deleted_at')) {
            $this->updateLog($user);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //TODO: Kullanıcıya ait article, blog, news... vb. kayıtlarda silinebilir.
        $this->log('delete', $user, $user->id, $user->toArray());
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //TODO: Kullanıcıya ait article, blog, news... vb. kayıtlarda geri getirilebilir.
        $this->log('restore', $user, $user->id, $user->toArray());
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //TODO: Kullanıcıya ait article, blog, news... vb. kayıtlarda silinebilir.
        $this->log('force_delete', $user, $user->id, $user->toArray());
    }
}
