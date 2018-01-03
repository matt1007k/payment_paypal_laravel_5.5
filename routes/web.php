<?php

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
Route::bind('product', function($slug){
	return App\Product::where('slug', $slug)->first();
});

Route::get('/', 'HomeController@shop');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/cart/show', [
	'as' => 'cart-show',
	'uses' => 'CartController@show'
]);
Route::get('/cart/add/{product}', [
	'as' => 'cart-add',
	'uses' => 'CartController@add'
]);
Route::get('/cart/delete/{product}', [
	'as' => 'cart-delete',
	'uses' => 'CartController@delete'
]);

// Paypal
// enviarmos nuestro pedido a Paypal
Route::get('payment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment'
));
// Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus'
));