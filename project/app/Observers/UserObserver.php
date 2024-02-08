<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\User;
use App\Models\UserVerification;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserVerificationNotification;
use Illuminate\Support\Str;

class UserObserver
{
    public function __construct(public Log $log)
    {

    }

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
        $this->log('create', $user->id, $user->toArray());
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

    public function updateLog(User $user): void
    {
        $change = $user->getDirty();
        if (!empty($change)) {
            $data = [];
            foreach ($change as $key => $value) {
                $data[$key]['old'] = $user->getOriginal($key);
                $data[$key]['new'] = $value;
            }
            if (isset($data['updated_at']['old'])) {
                $data['updated_at']['old'] = $data['updated_at']['old']->toDateTimeString();
            }
            $this->log('update', $user->id, $data);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->log('delete', $user->id, $user->toArray());
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        $this->log('restore', $user->id, $user->toArray());
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        $this->log('force_delete', $user->id, $user->toArray());
    }

    public function log(string $action, int $loggable_id, $data): void
    {
        $this->log::create([
            'user_id'       => auth()->guard('web')->id(),
            'action'        => $action,
            //'data'          => $user->toJson(),
            'data'          => json_encode($data),
            'loggable_id'   => $loggable_id,
            //'loggable_type' => get_class($user),
            'loggable_type' => User::class
        ]);
    }
}
