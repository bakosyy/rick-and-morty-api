<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function test()
    {
        return [
            "date" => Carbon::now()->toW3cString()
        ];
    }
}
