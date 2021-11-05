<?php

use App\Models\Location;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    dd(
        Location::first()->character
    );
});
