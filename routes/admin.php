<?php

use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CoverageController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){
    Route::get('/', [DashboardController::class, 'getDashboard'])->name('dashboard');

    //Module Settings
    Route::get('settings', [SettingsController::class, 'getHome'])->name('settings');
    Route::post('settings', [SettingsController::class, 'postHome'])->name('settings');

    //Module Users
    Route::get('/users/{status}/', [UserController::class, 'getUsers'])->name('users_list');
    Route::get('/users/{id}/view', [UserController::class, 'getUsersView'])->name('users_view');
    Route::post('/users/{id}/edit', [UserController::class, 'postUsersEdit'])->name('users_edit');
    Route::get('/users/{id}/banned', [UserController::class, 'getUsersBanned'])->name('users_banned');
    Route::get('/users/{id}/permissions', [UserController::class, 'getUsersPermissions'])->name('users_permissions');
    Route::post('/users/{id}/permissions', [UserController::class, 'postUsersPermissions'])->name('users_permissions');

    //Module products
    Route::get('/products/add', [ProductController::class, 'getProductAdd'])->name('products_add');
    Route::get('/products/{status}', [ProductController::class, 'getHome'])->name('products');
    Route::get('/products/{id}/edit', [ProductController::class, 'getProductEdit'])->name('products_edit');
    Route::get('/products/{id}/delete', [ProductController::class, 'getProductDelete'])->name('products_delete');
    Route::get('/products/{id}/restore', [ProductController::class, 'getProductRestore'])->name('products_delete');
    Route::get('/products/{id}/inventory', [ProductController::class, 'getProductInventory'])->name('products_inventory');
    Route::post('/products/add', [ProductController::class, 'postProductAdd'])->name('products_add');
    Route::post('/products/search', [ProductController::class, 'postProductSearch'])->name('products_search');
    Route::post('/products/{id}/edit', [ProductController::class, 'postProductEdit'])->name('products_edit');
    Route::post('/products/{id}/inventory', [ProductController::class, 'postProductInventory'])->name('products_inventory');
    Route::post('/products/{id}/gallery/add', [ProductController::class, 'postProductGalleryAdd'])->name('products_gallery_add');
    Route::get('/products/{id}/gallery/{gid}/delete', [ProductController::class, 'getProductGalleryDelete'])->name('products_gallery_deleted');
    
    //Module Inventory
    Route::get('/products/inventory/{id}/edit', [ProductController::class, 'getProductInventoryEdit'])->name('products_inventory');
    Route::post('/products/inventory/{id}/edit', [ProductController::class, 'postProductInventoryEdit'])->name('products_inventory');
    Route::post('/products/inventory/{id}/variant', [ProductController::class, 'postProductInventoryVariantAdd'])->name('products_inventory');
    Route::get('/products/inventory/{id}/delete', [ProductController::class, 'getProductInventoryDelete'])->name('products_inventory');
    Route::get('/products/variant/{id}/delete', [ProductController::class, 'getProductInventoryVariantDelete'])->name('products_inventory');
    

    //Module categories
    Route::get('/categories/{module}', [CategoriesController::class, 'getHome'])->name('categories');
    Route::post('/category/add/{module}', [CategoriesController::class, 'postCategoryAdd'])->name('categories_add');
    Route::get('/category/{id}/edit', [CategoriesController::class, 'getCategoryEdit'])->name('categories_edit');
    Route::post('/category/{id}/edit', [CategoriesController::class, 'postCategoryEdit'])->name('categories_edit');
    Route::get('/category/{id}/subs', [CategoriesController::class, 'getSubCategories'])->name('categories_edit');
    Route::get('/category/{id}/delete', [CategoriesController::class, 'getCategoryDelete'])->name('categories_deleted');

    //Module Sliders
    Route::get('/sliders', [SliderController::class, 'getHome'])->name('sliders_list');
    Route::post('/sliders/add', [SliderController::class, 'postSliderAdd'])->name('sliders_add');
    Route::get('/sliders/{id}/edit', [SliderController::class, 'getEditSlider'])->name('sliders_edit');
    Route::post('/sliders/{id}/edit', [SliderController::class, 'postEditSlider'])->name('sliders_edit');
    Route::get('/sliders/{id}/delete', [SliderController::class, 'postDeleteSlider'])->name('sliders_delete');

    //Module coverage
    Route::get('/coverage', [CoverageController::class, 'getList'])->name('coverage_list');
    Route::post('/coverage/state/add', [CoverageController::class, 'postCoverageStateAdd'])->name('coverage_add');
    Route::post('/coverage/city/add', [CoverageController::class, 'postCoverageCityAdd'])->name('coverage_add');
    Route::get('/coverage/{id}/edit', [CoverageController::class, 'getCoverageEdit'])->name('coverage_edit');
    Route::get('/coverage/city/{id}/edit', [CoverageController::class, 'getCoverageCityEdit'])->name('coverage_edit');
    Route::post('/coverage/city/{id}/edit', [CoverageController::class, 'postCoverageCityEdit'])->name('coverage_edit');
    Route::post('/coverage/state/{id}/edit', [CoverageController::class, 'postCoverageStateEdit'])->name('coverage_edit');
    Route::get('/coverage/{id}/cities', [CoverageController::class, 'getCoverageCities'])->name('coverage_list');
    Route::get('/coverage/{id}/delete', [CoverageController::class, 'getCoverageDelete'])->name('coverage_delete');

    //Module Orders
    Route::get('/orders/{status}/{type}', [OrderController::class, 'getList'])->name('orders_list');
    Route::get('/order/{order}/view', [OrderController::class, 'getOrder'])->name('orders_view');
    Route::post('/order/{order}/view', [OrderController::class, 'postOrderStatusUpdate'])->name('orders_view');

    //API javascript request
    Route::get('hm/api/load/subcategories/{parent}', [ApiController::class, 'getSubCategories'])->name('API_get_subcategories');
});