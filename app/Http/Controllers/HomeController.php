<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\DeviceService;
use App\Services\SettingService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    private DeviceService $deviceService;
    /**
     * @var SettingService
     */
    private SettingService $settingService;

    public function __construct(DeviceService $deviceService, SettingService $settingService)
    {
        $this->middleware('auth');
        $this->deviceService = $deviceService;
        $this->settingService = $settingService;
    }

    public function index(): Renderable
    {
        return view('home')->with(
            [
                'devices' => Device::all(),
                'farthestDevices' => $this->deviceService->getFarthestDevices(),
                'distanceApart' => $this->settingService->get(config('setting.distance_apart')),
            ]
        );
    }
}
