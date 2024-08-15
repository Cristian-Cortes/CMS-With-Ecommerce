<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ApiJsController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CarController;
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

Route::get('/', [ContentController::class, 'getHome'])->name('home');

//Module shooping cart
Route::get('/cart', [CarController::class, 'getCart'])->name('cart');
Route::post('/cart', [CarController::class, 'postCart'])->name('cart');
Route::post('/cart/product/{id}/add', [CarController::class, 'postCartAdd'])->name('cart_add');
Route::post('/cart/item/{id}/update', [CarController::class, 'postCartItemQuantityUpdate'])->name('cart_item_update');
Route::get('/cart/item/{id}/delete', [CarController::class, 'getCartItemDelete'])->name('cart_item_delete');
Route::get('/cart/{order}/type/{type}', [CarController::class, 'getCartChangeType'])->name('cart');

//Module store
Route::get('/store', [StoreController::class, 'getStore'])->name('store');
Route::get('/store/category/{id}/{slug}', [StoreController::class, 'getCategory'])->name('store_category');

Route::post('/search', [StoreController::class, 'postSearch'])->name('search');

//Route Autentication
Route::get('login', [ConnectController::class, 'getlogin'])->name('login');
Route::post('login', [ConnectController::class, 'postlogin'])->name('login');
Route::get('recover', [ConnectController::class, 'getRecover'])->name('recover');
Route::post('recover', [ConnectController::class, 'postRecover'])->name('recover');
Route::get('reset', [ConnectController::class, 'getReset'])->name('reset');
Route::post('reset', [ConnectController::class, 'postReset'])->name('reset');
Route::get('register', [ConnectController::class, 'getregister'])->name('register');
Route::post('register', [ConnectController::class, 'postregister'])->name('register');
Route::get('logout', [ConnectController::class, 'getlogout'])->name('logout');

//Module products
Route::get('/products/{id}/{slug}', [ProductController::class, 'getProduct'])->name('get_product');

//Module User Action
Route::get('/account/edit', [UserController::class, 'getAccountEdit'])->name('account_edit');
Route::post('/account/edit/avatar', [UserController::class, 'postAccountAvatar'])->name('account_edit_avatar');
Route::post('/account/edit/password', [UserController::class, 'postAccountPassword'])->name('account_edit_password');
Route::post('/account/edit/info', [UserController::class, 'postAccountInfo'])->name('account_edit_info');
Route::get('/account/address', [UserController::class, 'getAccountAddress'])->name('account_address');
Route::post('/account/address/add', [UserController::class, 'postAccountAddressAdd'])->name('account_address');
Route::get('/account/address/{address}/setdefault', [UserController::class, 'getAccountAddressSetdefault'])->name('account_address');
Route::get('/account/address/{address}/delete', [UserController::class, 'getAccountAddressDelete'])->name('account_address');
Route::get('/account/history/orders', [UserOrderController::class, 'getHistory'])->name('account_user_orders_history');
Route::get('/account/history/order/{order}', [UserOrderController::class, 'getOrder'])->name('account_user_order_details');

//Ajax API Routes
Route::get('/hm/api/load/products/{section}', [ApiJsController::class, 'getProductsSection'])->name('api_get_products');
Route::post('/hm/api/load/user/favorites/', [ApiJsController::class, 'postUserFavorites'])->name('api_favorite_load');
Route::post('/hm/api/favorites/add/{object}/{module}', [ApiJsController::class, 'postFavoriteAdd'])->name('api_favorite_add');
Route::post('/hm/api/load/products/inventory/{inv}/variants', [ApiJsController::class, 'postProductInventoryVariants'])->name('api_products_inventory_variants');
Route::post('/hm/api/load/cities/{state_id}', [ApiJsController::class, 'postCoverageCitiesFromState'])->name('api_coverage_cities');
