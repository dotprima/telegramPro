<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
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
Route::get('/data', [DataController::class, 'index'])->name('data');

Route::get('/ajax/chart1', [DataController::class, 'chart1'])->name('chart1');


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profil'])->name('profile');
    Route::get('/profile/setting/security', [ProfileController::class, 'profileSecurity'])->name('profile.profileSecurity');
    Route::get('/profile/setting', [ProfileController::class, 'profileAccount'])->name('profile.profileAccount');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->group(function () {
    Route::resource('languages', LanguageController::class)->except([
        'create', 'show',
    ])->names([
        'index' => 'languages.index',
        'store' => 'languages.store',
        'update' => 'languages.update',
        'destroy' => 'languages.destroy',
    ]);
});
require __DIR__ . '/auth.php';
