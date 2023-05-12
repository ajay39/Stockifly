<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoggedDevice;

class LoggedDeviceController extends Controller
{
    //
    public function index()
    {
        $items = LoggedDevice::all();
        return response()->json($items);
    }

}
