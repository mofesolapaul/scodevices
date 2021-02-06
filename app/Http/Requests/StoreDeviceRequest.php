<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'device_id' => 'required|unique:devices|min:6|regex:/[A-Za-z0-9]{6,}/',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'work' => 'required',
        ];
    }
}
