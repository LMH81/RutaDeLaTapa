<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapaController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarController;
use App\Http\Controllers\BarTapaController;
use App\Http\Controllers\CookiesController;
use App\Models\Tapa;

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

    // // Route::get('bar-tapa', 'BarTapaController@index')->name('bar_tapa.index');
    // // Route::get('bar-tapa/create', 'BarTapaController@create')->name('bar_tapa.create');
    // // Route::post('bar-tapa/assign', 'BarTapaController@assign')->name('bar_tapa.assign');
    // // Route::post('bar-tapa/delete', 'BarTapaController@delete')->name('bar_tapa.delete');

    // // Route::resource('bar_tapa', App\Http\Controllers\BarTapaController::class);

    Route::get('/bar_tapa','App\Http\Controllers\BarTapaController@index')->name('bar_tapa.index');    
    Route::get('/bar_tapa/create','App\Http\Controllers\BarTapaController@create')->name('bar_tapa.create');
    Route::post('/bar_tapa','App\Http\Controllers\BarTapaController@store')->name('bar_tapa.store');
    Route::get('/bar_tapa/{id}/edit','App\Http\Controllers\BarTapaController@edit')->name('bar_tapa.edit');
    Route::put('/bar_tapa/{id}','App\Http\Controllers\BarTapaController@update')->name('bar_tapa.update');
    Route::delete('/bar_tapa/{id}','App\Http\Controllers\BarTapaController@destroy')->name('bar_tapa.delete');


   /*------------------------Rutas Autorizadas------------------------------*/ 

    Route::get('tapa', function () {
        Gate::authorize('tapa');
        $tapas = App\Models\Tapa::paginate(10);
        return view('tapa.index', compact('tapas'));
    })->name('tapa');

    Route::get('bars', function () {
        Gate::authorize('bars');
        $bars = App\Models\Bar::paginate(10);
        return view('bar.index', compact('bars'));
    })->name('bars');

    Route::get('bar_tapa', function () {
        Gate::authorize('bar_tapa');
        return view('bar_tapa.index');
    })->name('bar_tapa');

    Route::get('vote-tapa', function () {
        Gate::authorize('vote-tapa');
        return view('vote_tapa.index');
    })->name('vote-tapa');

});


