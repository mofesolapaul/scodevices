<?php

namespace App\Providers;

use App\Events\DeviceAddedEvent;
use App\Listeners\CalculateFarthestDevicesListener;
use App\Listeners\DeviceCoordinatesToAddressListener;
use App\Listeners\SendMailForWorkDeviceListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DeviceAddedEvent::class => [
            DeviceCoordinatesToAddressListener::class,
            SendMailForWorkDeviceListener::class,
            CalculateFarthestDevicesListener::class,
        ]
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
}
