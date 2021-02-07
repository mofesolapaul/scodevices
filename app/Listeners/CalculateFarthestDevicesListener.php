<?php

namespace App\Listeners;

use App\Events\DeviceAddedEvent;
use App\Services\FarthestDevicesCalculatorService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculateFarthestDevicesListener implements ShouldQueue
{
    private FarthestDevicesCalculatorService $calculatorService;

    public function __construct(FarthestDevicesCalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
    }

    public function handle(DeviceAddedEvent $event)
    {
        $this->calculatorService->updateFarthestDevices();
    }
}
