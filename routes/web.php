<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PtnController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\FEController;
use App\Http\Controllers\UserController;
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

Route::controller(PtnController::class)->group(function(){
    Route::get('/admin-univ','univ_page');
    Route::post('/admin-import-univ','import_univ');
    Route::get('/data-univ','data_univ');
    Route::get('/total-univ','total_univ');
});

Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin-dashboard','index');
    });
    
    // Route::controller(PtnController::class)->group(function(){
    //     Route::get('/admin-univ','univ_page');
    //     Route::post('/admin-import-univ','import_univ');
    //     Route::get('/data-univ','data_univ');
    //     Route::get('/total-univ','total_univ');
    // });
    
    Route::controller(JurusanController::class)->group(function(){
        Route::get('/admin-jurusan','jurusan_page');
        Route::get('/data-jurusan','data_jurusan');
        Route::get('/total-jurusan','total_jurusan');
    });
    
    Route::controller(SiswaController::class)->group(function(){
        Route::get('/admin-siswa','siswa_page');
        Route::get('/data-siswa','data_siswa');
        Route::get('/total-siswa','total_siswa');
        Route::post('/admin-import-siswa','import_siswa');
        
        Route::get('/generate-user-and-siswa','generate_user_and_siswa');
        Route::post('/admin-update-siswa','update_siswa');
        Route::get('/admin-siswa-export','export_siswa'); 

        Route::post('/admin-hapus-siswa','hapus_siswa');
        Route::get('/admin-status-siswa','status_siswa');
        Route::get('/admin-rating-siswa','rating_siswa');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/admin-daftar-user','daftar_user');
        Route::get('/total-user','total_user');
        Route::post('/admin-add-user','add_user');
        Route::post('/admin-hapus-user','hapus_user');
        Route::post('/admin-import-user','import_user');
    });
});


//FE
Route::controller(FEController::class)->group(function(){
    Route::get('/landing-page','landing_page');
    Route::get('/daftar-ptn','daftar_ptn');
    Route::get('/my-info','my_info');
    Route::post('/submit-data-siswa','submit_data_siswa');
    Route::post('/pilih-ptn','pilih_univ');
    Route::post('/proses-rating','proses_rating');
    Route::get('/my-choice','my_choice');
    Route::post('/hapus-ptn-pilihan','hapus_ptn_pilihan');
    Route::get('/daftar-ptn-filter-jurusan/{jurusan}','filter_jurusan');
    Route::get('/daftar-ptn-filter-ptn/{ptn}','filter_ptn');
    Route::get('/daftar-ptn-search/{ptn}','search_ptn');
    Route::get('/daftar-siswa-mengambil-ptn/{ptn}/{jurusan}','daftar_siswa_ptn');
}); 