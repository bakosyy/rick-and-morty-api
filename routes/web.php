<?php

use App\Models\User;
use App\Models\Image;
use App\Models\Character;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('test', function () {
    dd( Image::find(12) );
});
