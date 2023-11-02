<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GetInTouchController;
use App\Http\Controllers\Dashboard\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    route::get('index', [GetInTouchController::class, 'table'])->name('contact.index');
    Route::get('/export-get-in-touch', 'ExportController@export')->name('export');
    route::post('export-excel', [GetInTouchController::class, 'export'])->name('contact.us.export');
        // route::post('user-list/status/{id}', [UserController::class, 'status'])->name('user.status');
    Route::post('/user/status/{id}', [UserController::class, 'status'])->name('user.status');
});
Route::get('/run', function () {
    Artisan::call("migrate");
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache has been cleared';
});
Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Optimized Successfully';
});
Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    return 'Cleared Successfully';
});

route::get('/dashboard',[DashboardController::class,'counts'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return ('connetion');
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});
require __DIR__ . '/auth.php';
