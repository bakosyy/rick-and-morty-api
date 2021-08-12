<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    public function test()
    {
        return [
            "date" => Carbon::now()->toW3cString()
        ];
    }
}
