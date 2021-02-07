<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Device;

class DeviceService
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function getFarthestDevices(): ?array
    {
        $updating = (bool)$this->settingService->get(config('setting.updating_farthest_devices'));
        $ids = $this->settingService->get(config('setting.farthest_devices'));

        if ($updating || !$ids) {
            return null;
        }

        $idArray = json_decode($ids, true);
        $devices = [];
        foreach ($idArray as $id) {
            $devices[] = Device::whereId($id)->first();
        }

        return $devices;
    }
}
