<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        return view('home')->with(
            [
                'devices' => Device::all(),
            ]
        );
    }
}
