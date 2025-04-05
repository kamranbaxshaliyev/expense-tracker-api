<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/migrate', function () {
    // Run migrations
    try {
        Artisan::call('migrate', ['--force' => true]);
        return response()->json(['message' => 'Migrations ran successfully.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Migrations failed', 'message' => $e->getMessage()], 500);
    }
});
