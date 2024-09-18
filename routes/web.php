<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mycontroller;
use App\Http\Controllers\WebController;

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



// website controller


Route::get('/', [WebController::class, 'WebsiteView']);
Route::get('/addtocart/{id}', [WebController::class, 'AddToCart']);


Route::post('/abc',[mycontroller::class,('insertdata')]);
Route::post('/updprod',[mycontroller::class,('insertproduct')]);
Route::get('/fetch',[mycontroller::class,('getdata')]);

Route::post('/del/{id}',[mycontroller::class,('delrecord')]);
Route::post('/upd/{id}',[mycontroller::class,('updateuser')]);
Route::post('/updaterecord',[mycontroller::class,('update')]);


// admin panel

Route::get('/showproduct', [mycontroller::class, 'ShowProduct']);
Route::get('/deleteproduct/{id}', [mycontroller::class, 'DeleteProductAdmin']);
Route::get('/editproduct/{id}', [mycontroller::class, 'EditProductView']);
Route::post('/updateproduct/{id}', [mycontroller::class, 'EditProductAdmin']);

Route::get('/showuser', [mycontroller::class,'ShowUser']);
Route::get('/deleteuser/{id}', [mycontroller::class, 'DeleteUser']);
Route::get('/edituser/{id}', [mycontroller::class, 'EditUserView']);
Route::post('/updateuser/{id}', [mycontroller::class, 'EditUser']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::User()->role == 1)
       {
        return view('index');
       }
       else{
        return view('AdminDashboard.index');
       }
    })->name('dashboard');

    Route::get('/upload', function () {
        return view('AdminDashboard.uploadproduct');
    });
    Route::get('/prods',[mycontroller::class,('getproducts')]);

    Route::get('/checkout',[mycontroller::class,('checkout')]);
    Route::post('/deleteproduct/{id}',[mycontroller::class,('deleteproduct')]);
});
Route::post('/insprod',[mycontroller::class,('insertproducts')]);
