<?php

namespace App\Observers;

use App\Models\SocialMedia;
use App\Models\User;
use App\Models\UserSocial;

class SocialMediaObserver
{
    /**
     * Handle the SocialMedia "created" event.
     */
    public function created(SocialMedia $socialMedia): void
    {
        $users = User::query()->select(['id'])->get();
        if (!empty($users)) {
            foreach ($users as $user) {
                UserSocial::query()->insert([
                    'social_id' => $socialMedia->id, 'user_id' => $user->id, 'status' => $socialMedia->status
                ]);
            }
        }
    }

    /**
     * Handle the SocialMedia "updated" event.
     */
    public function updated(SocialMedia $socialMedia): void
    {
        if ($socialMedia->isDirty('status')) {
            UserSocial::query()->where('social_id', $socialMedia->id)->update(['status' => $socialMedia->status]);
        }
    }

    /**
     * Handle the SocialMedia "deleted" event.
     */
    public function deleted(SocialMedia $socialMedia): void
    {
        UserSocial::query()->where('social_id', $socialMedia->id)->delete();
    }

    /**
     * Handle the SocialMedia "restored" event.
     */
    public function restored(SocialMedia $socialMedia): void
    {
        //
    }

    /**
     * Handle the SocialMedia "force deleted" event.
     */
    public function forceDeleted(SocialMedia $socialMedia): void
    {
        UserSocial::query()->where('social_id', $socialMedia->id)->delete();
    }
}
