<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Fis;
use Illuminate\Support\Facades\Cache;

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
    $fis = new Fis;

    $arrivals = Cache::remember('flights.arrivals', 30, function () use ($fis) {
        return $fis->getFlights('arrivals');
    });

    $depatures = Cache::remember('flights.depatures', 30, function () use ($fis) {
        return $fis->getFlights('depatures');
    });



    return view('index', [
        'arrivals' => collect($arrivals),
        'depatures' => collect($depatures)
    ]);
});
