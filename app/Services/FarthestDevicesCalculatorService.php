<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Device;

class FarthestDevicesCalculatorService
{
    private const EARTH_RADIUS = 6378;

    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    private function getCoordinates(Device $device)
    {
        return [
            'x' => self::EARTH_RADIUS * cos(deg2rad((float)$device->latitude)) *
                cos(deg2rad((float)$device->longitude)),
            'y' => self::EARTH_RADIUS * cos(deg2rad((float)$device->latitude)) *
                sin(deg2rad((float)$device->longitude)),
        ];
    }

    public function updateFarthestDevices()
    {
        $maxDistance = 0;
        $farthestDevices = [null, null];

        $devices = Device::all();
        $count = $devices->count();

        if ($count < 2) {
            return;
        }

        $this->settingService->put(config('setting.updating_farthest_devices'), true);
        for ($i = 0; $i < $count - 1; $i++) {
            $device1Coordinates = $this->getCoordinates($devices[$i]);
            for ($j = $i + 1; $j < $count; $j++) {
                $device2Coordinates = $this->getCoordinates($devices[$j]);
                $distanceBetweenPoints = sqrt(
                    (($device2Coordinates['x'] - $device1Coordinates['x']) ** 2) +
                    (($device2Coordinates['y'] - $device1Coordinates['y']) ** 2)
                );

                if ($distanceBetweenPoints > $maxDistance) {
                    $maxDistance = $distanceBetweenPoints;
                    $farthestDevices[0] = $devices[$i]->id;
                    $farthestDevices[1] = $devices[$j]->id;
                }
            }
        }

        $this->settingService->put(config('setting.farthest_devices'), json_encode($farthestDevices));
        $this->settingService->put(config('setting.distance_apart'), $maxDistance);
        $this->settingService->put(config('setting.updating_farthest_devices'), false);
    }
}
