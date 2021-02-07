<?php

namespace App\Http\Controllers;

use App\Events\DeviceAddedEvent;
use App\Http\Requests\StoreDeviceRequest;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DeviceController extends Controller
{
    public function store(StoreDeviceRequest $request): RedirectResponse
    {
        $device = new Device();
        $device->user_id = Auth::user()->id;
        $device->device_id = $request->get('device_id');
        $device->longitude = $request->get('longitude');
        $device->latitude = $request->get('latitude');
        $device->work = $request->get('work');
        $device->save();
        DeviceAddedEvent::dispatch($device);

        return Redirect::route('home')->with(['status' => 'Device added successfully.']);
    }

    public function list() {
        $devices = Device::with('user')->get();
        return new JsonResponse($devices);
    }

    public function destroy(Device $device)
    {
        //
    }
}
