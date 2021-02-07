<?php

namespace App\Listeners;

use App\Events\DeviceAddedEvent;
use App\Services\DeviceCoordsToAddressService;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeviceCoordinatesToAddressListener implements ShouldQueue
{
    private DeviceCoordsToAddressService $addressService;

    public function __construct(DeviceCoordsToAddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function handle(DeviceAddedEvent $event)
    {
        $this->addressService->geocode($event->device);
    }
}
