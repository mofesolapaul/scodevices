<?php

namespace App\Listeners;

use App\Events\DeviceAddedEvent;
use App\Mail\DeviceAddedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailForWorkDeviceListener implements ShouldQueue
{
    public function handle(DeviceAddedEvent $event)
    {
        Mail::to(config('mail.admin_email'))->send(new DeviceAddedMail($event->device));
    }

    public function shouldQueue(DeviceAddedEvent $event): bool
    {
        return (bool)$event->device->work;
    }
}
