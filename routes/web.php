<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PdfController;


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


Route::get('/', [ClientsController::class, 'home']);

Route::get("/shop", [ClientsController::class, 'shop']);

Route::get('/cart', [ClientsController::class, 'cart']);

Route::get('/checkout', [ClientsController::class, 'checkout']);

Route::get('/register', [ClientsController::class, 'register']);

Route::get('/login', [ClientsController::class, 'signin']);

Route::get('/addtocart/{id}', [ClientsController::class, 'addtocart']);

Route::put('cart/updateqty/{id}', [ClientsController::class, 'updateqty']);

Route::get('cart/removeitem/{id}', [ClientsController::class, 'removeitem']);

Route::post('createaccount', [ClientsController::class, 'createaccount']);

Route::post('connect', [ClientsController::class, 'accessaccount']);

Route::get('logout', [ClientsController::class, 'logout']);

Route::post('payer', [ClientsController::class, 'pay']);

Route::get('/paymentSuccess', [ClientsController::class, 'paymentSuccess']);


//Admin Route
Route::get('/admin', [AdminController::class, 'home']);

Route::get('/admin/categories/add', [AdminController::class, 'addcat']);

Route::get('/admin/categories', [AdminController::class, 'listcat']);

Route::get('/admin/sliders/add', [AdminController::class, 'addslider']);

Route::get('/admin/sliders', [AdminController::class, 'listslider']);

Route::get('/admin/products/add', [AdminController::class, 'addproduct']);

Route::get('/admin/products', [AdminController::class, 'listproduct']);

Route::get('/admin/orders', [AdminController::class, 'listorder']);


//Category Route
Route::post('/admin/savecat', [CategoryController::class, 'savecat']);

Route::delete('/admin/delcat/{id}', [CategoryController::class, 'delcat']);

Route::get('admin/editcat/{id}', [CategoryController::class, 'editcat']);

Route::put("/admin/updatecate/{id}", [CategoryController::class, 'update']);

//Sliders Route
Route::post('/admin/saveslider', [SliderController::class, 'save']);

Route::delete('/admin/delslid/{id}', [SliderController::class, 'delslid']);

Route::get('admin/editslid/{id}', [SliderController::class, 'editslid']);

Route::put("/admin/updateslid/{id}", [SliderController::class, 'update']);

Route::put('admin/unactslid/{id}', [SliderController::class , 'unactivate']);

Route::put('admin/actslid/{id}', [SliderController::class , 'activate']);

//Products Route
Route::post('admin/saveprod', [ProductController::class, 'add']);

Route::delete('admin/delprod/{id}', [ProductController::class, 'delprod']);

Route::get('admin/editprod/{id}', [ProductController::class, 'editprod' ]);

Route::put('admin/updateprod/{id}', [ProductController::class, 'updateprod']);

Route::put('admin/actprod/{id}', [ProductController::class, 'activate']);

Route::put('admin/unactprod/{id}', [ProductController::class, 'unactivate']);

//Pdf Routes
Route::get('view_order/{id}', [PdfController::class, "see"]);
