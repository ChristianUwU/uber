<?php

namespace App\Providers;
<<<<<<< Updated upstream

use App\Events\BVehiculoCreateEvent;
use App\Events\BVehiculoDestroyEvent;
use App\Events\BVehiculoEditEvent;
use App\Listeners\BVehiculoCreateListener;
use App\Listeners\BVehiculoDestroyListener;
use App\Listeners\BVehiculoEditListener;
=======
//////////////////////////////////////////
use App\Events\BClienteCreateEvent;
use App\Listeners\BClienteCreateListener;
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
//////////////////////////////////////////
>>>>>>> Stashed changes
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
<<<<<<< Updated upstream
        BVehiculoCreateEvent::class => [
            BVehiculoCreateListener::class,
        ],
        BVehiculoDestroyEvent::class => [
            BVehiculoDestroyListener::class,
        ],
        BVehiculoEditEvent::class => [
            BVehiculoEditListener::class,
=======
        //conexion de evento y listener de bitacora cliente create by Julico
        BClienteCreateEvent::class =>[
            BClienteCreateListener::class,
>>>>>>> Stashed changes
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
