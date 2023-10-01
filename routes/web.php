<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapaController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarController;
use App\Http\Controllers\BarTapaController;
use App\Http\Controllers\CookiesController;



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

Route::get('/', [CookiesController::class, 'setCookie'])->name('setCookie');
Route::get('/get-cookie',[CookiesController::class,'getCookie']);
Route::get('/del-cookie',[CookiesController::class,'delCookie']);
Route::get('/cookies_required', function () {
    return view('cookies_required');
})->name('cookies_required');


Auth::routes();

Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    /*---------------------Rutas TapaController-------------------------------------*/
    Route::get('/tapa/chartbar', [App\Http\Controllers\ChartController::class, 'chartbar'])->name('tapa.chart'); ;   
    Route::get('/tapa/pdf', [App\Http\Controllers\TapaController::class, 'pdf'])->name('tapa.pdf'); 
    
    Route::resource('tapa', TapaController::class);
           
        

    /*---------------------Rutas BarController-------------------------------------*/ 
    Route::get('/bar/pdf', [App\Http\Controllers\BarController::class, 'pdf'])->name('bar.pdf'); 
    Route::resource('bar', 'App\Http\Controllers\BarController');
    Route::get('/bars/{id}', 'BarController@show');   
    Route::get('/bars', [BarController::class, 'index'])->name('bar.index');   
    Route::post('/bars', [BarController::class, 'store'])->name('bar.store');
    Route::get('/bars/{id}/edit', [BarController::class, 'edit'])->name('bar.edit');
    Route::patch('/bars/{id}', [BarController::class, 'update'])->name('bar.update');
    Route::get('/bars/{id}', [BarController::class, 'show'])->name('bar.show');
    Route::delete('/bars/{id}', [BarController::class, 'destroy'])->name('bar.delete');

    // /*-------------------------Rutas BarTapaController--------------------------*/

     
    Route::resource('bar_tapa', BarTapaController::class);
   
           
    

   /*------------------------Rutas Autorizadas------------------------------*/ 

    Route::get('tapa', function () {
        //Gate::authorize('tapa');
        $tapas = App\Models\Tapa::paginate(10);
        return view('tapa.index', compact('tapas'));
    })->name('tapa');

    Route::get('bars', function () {
        //Gate::authorize('bars');
        $bars = App\Models\Bar::paginate(10);
        return view('bar.index', compact('bars'));
    })->name('bars');

    Route::get('bar_tapa', function () {
       // Gate::authorize('bar_tapa');
        return view('bar_tapa.index');
    })->name('bar_tapa');

    Route::get('vote-tapa', function () {
       // Gate::authorize('vote-tapa');
        return view('vote_tapa.index');
    })->name('vote-tapa');

});


