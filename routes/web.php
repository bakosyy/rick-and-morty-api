<?php

use App\Models\User;
use App\Models\Image;
use App\Models\Episode;
use App\Models\Location;
use App\Models\Character;
use App\Services\v1\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('test/{code}', function ($code) {
    dd(request()->route('code'));
});
