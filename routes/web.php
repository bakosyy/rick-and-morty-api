<?php

use App\Models\User;
use App\Models\Character;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(request('status')){
        dd('status is here');
    }
    else{
        dd('status is absent');
    }
    return User::select('id', 'name', 'status', 'gender')
        // ->when(request()->has('status'), function ($query) {
        //     foreach (request('status') as $key => $value) {
        //         $query->orWhere('status', $value);
        //     }
        // })
        // ->when(request()->has('gender'), function ($query) {
        //     foreach (request('gender') as $key => $value) {
        //         $query->orWhere('gender', $value);
        //     }
        // })
        ->when(request('gender'), static function ($query, $value) {
            $query->whereIn('gender', $value);
        })
        ->when(request('status'), static function ($query, $value) {
            $query->whereIn('status', $value);
        })
        ->toSql();  
});
