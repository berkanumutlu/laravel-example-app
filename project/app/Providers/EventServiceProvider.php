<?php

namespace App\Providers;

//use App\Events\UserRegistered;
//use App\Listeners\SendEmailUserVerificationListener;
use App\Models\User;
use App\Observers\UserRegisteredObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        /*UserRegistered::class => [
            SendEmailUserVerificationListener::class
        ]*/
    ];

    protected $observers = [
        User::class => UserRegisteredObserver::class
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //User::observe(UserRegisteredObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
