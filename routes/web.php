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

Route::get('payment/success/{user_id?}', 'Api\PaypalController@success')->name('payment.success');
Route::get('payment/cancel/{user_id?}', 'Api\PaypalController@cancel')->name('payment.cancel');

Route::prefix('shop')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Api')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('shop.')
    ->group(function () {
        Route::get('/products', 'ProductController@index');
        Route::post('/products', 'ProductController@index')->name('products.search');
        Route::get('/products/{id}', 'ProductController@show');
        Route::get('/products/siblings/{id}', 'ProductController@siblings');

        Route::get('/categories', 'CategoryController@index');
        Route::get('/categories/{id}', 'CategoryController@show');

        Route::resource('/personalizes', 'PersonalizeController')->only(['store', 'destroy']);
    });

Route::get('/shop/user', function (Request $request) {
    if (auth()->check()) {
        return response()->json([
            'name'    => $request->user()->name,
            'email'   => $request->user()->email,
            'is_auth' => true
        ]);
    } else {
        return response()->json([
            'name'    => null,
            'email'   => null,
            'is_auth' => false
        ]);
    }
});

Auth::routes();

// ! proteggo tutte le rotte con il middleware: devo essere autenticato altrimenti non mi viene restituita la pagina di login
Route::middleware(['auth', 'admin'])
    //! aggiorna ogni url
    ->prefix('admin')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Admin')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('users', 'UserController');
        Route::resource('products', 'ProductController');
        Route::resource('orders', 'OrderController');
        Route::resource('payments', 'PaymentController');
        Route::resource('categories', 'CategoryController');
        Route::resource('subcategories', 'SubcategoryController');

        // 👉 Get table data
        Route::post('/users/data', 'UserController@index');
        Route::post('/products/data', 'ProductController@index');
        Route::post('/payments/data', 'PaymentController@index');
        Route::post('/categories/data', 'CategoryController@index');
        Route::post('/subcategories/data', 'SubcategoryController@index');
    });

Route::middleware('auth')
    //! aggiorna ogni url
    ->prefix('shop')
    //! aggiorna la cartella all'interno della quale si trovano i controller
    ->namespace('Api')
    //! aggiorna la cartella all'interno della quale si trovani i blade
    ->name('shop.')
    ->group(function () {
        Route::get('/orders/{order}', 'OrderController@show');
        Route::post('/orders', 'OrderController@store');

        Route::get('/users', function (Request $request) {
            return $request->user();
        });

        Route::get('/users/detail', 'UserController@show');

        Route::get('/payment', 'PaypalController@payment')->name('payment');

        Route::get('/carts', 'UserCartController@index')->name('carts');
        Route::post('/carts', 'UserCartController@store')->name('carts.store');
        Route::delete('/carts/{id}', 'UserCartController@destroy')->name('carts.delete');
    });

Route::get("{any?}", function () {
    return view("guest.home");
})->where("any", ".*");
