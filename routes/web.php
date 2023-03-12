<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PtnController;
use App\Http\Controllers\FEController;
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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/landing-page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(DashboardController::class)->group(function(){
    Route::get('/admin-dashboard','index');
});

Route::controller(PtnController::class)->group(function(){
    Route::get('/admin-univ','univ_page');
    Route::post('/admin-import-univ','import_univ');
});

//FE
Route::controller(FEController::class)->group(function(){
    Route::get('/landing-page','landing_page');
});