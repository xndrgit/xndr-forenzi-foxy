<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


// ! proteggo tutte le rotte con il middleware: devo essere autenticato altrimenti non mi viene restituita la pagina di login
Route::middleware('auth')
    //! aggiorna ogni url
    ->prefix('admin')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Admin')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('admin.')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/products', 'ProductController');
        Route::resource('/orders', 'OrderController');
        Route::resource('/payments', 'PaymentController');
        Route::resource('/users', 'UserController');
        Route::resource('/categories', 'CategoryController');
    });

Route::prefix('user')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Api')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('user.')
    ->group(function () {
        Route::get('/products', 'ProductController@index');
        Route::get('/products/{id}', 'ProductController@show');
        Route::get('/products/siblings/{id}', 'ProductController@siblings');
        // Route::get('/products/{id}', 'ProductController@destroy');

        Route::get('/categories', 'CategoryController@index');
        Route::get('/categories/{id}', 'CategoryController@show');

        Route::get('/orders', 'OrderController@index');
    });

Route::middleware('auth')
    //! aggiorna ogni url
    ->prefix('guest')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Api')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('guest.')
    ->group(function () {
        Route::put('/orders', 'OrderController@show');
        Route::post('/orders', 'OrderController@create');
        Route::post('/orders/{id}', 'OrderController@update');
        Route::post('/orders/transmit/{id}', 'OrderController@transmit');
        Route::post('/orders/delete/{id}', 'OrderController@destroy');

        Route::get('/user/detail', 'UserController@show');
        Route::get('/user', function (Request $request) {
            return response()->json([
                'name'  => $request->user()->name,
                'email' => $request->user()->email,
            ]);
        });
    });

Route::get("{any?}", function () {
    return view("guest.home");
})->where("any", ".*");
