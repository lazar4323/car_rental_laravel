<?php

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

Route::get('/', [App\Http\Controllers\AdminController::class, 'welcome'])->name('welcome');

Auth::routes();


Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.home');

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.vehicles')->middleware('is_admin');
Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');

Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->name('home.addDeposit');

Route::get('/admin/home/new-car', [App\Http\Controllers\HomeController::class, 'newCar'])->name('home.newCar')->middleware('is_admin');
Route::post('/admin/home/save-car', [App\Http\Controllers\HomeController::class, 'saveCar'])->name('home.saveCar')->middleware('is_admin');

Route::get('/admin/home/edit-car/{id}', [App\Http\Controllers\HomeController::class, 'editCar'])->name('home.editCar')->middleware('is_admin');
Route::put('/admin/home/update-car/{id}', [App\Http\Controllers\HomeController::class, 'updateCar'])->name('home.updateCar')->middleware('is_admin');


Route::get('/user/rent-view/{id}', [App\Http\Controllers\VehicleController::class, 'rentView'])->name('home.rentView');
Route::post('/user/rent-vehicle/{id}', [App\Http\Controllers\VehicleController::class, 'rentVehicle'])->name('home.rentVehicle');

Route::get('/admin/home/requests', [App\Http\Controllers\HomeController::class, 'showRents'])->name('home.showRents')->middleware('is_admin');

Route::get('/admin/home/requests/reply', [App\Http\Controllers\HomeController::class, 'reply'])->name('home.reply')->middleware('is_admin');
Route::post('/admin/home/requests/reply', [App\Http\Controllers\HomeController::class, 'replyStore'])->name('home.replyStore')->middleware('is_admin');


Route::get('/user/show-replies', [App\Http\Controllers\UserController::class, 'showReplies'])->name('user.showReplies');

Route::get('/admin/home/delete-vehicle/{id}', [App\Http\Controllers\HomeController::class, 'deleteVehicle'])->name('home.deleteVehicle');

