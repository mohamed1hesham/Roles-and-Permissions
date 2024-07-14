<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('homepage');
//signup
Route::get('/registeration', [SignupController::class, 'index'])->name('signup_page');
Route::post('/reg', [SignupController::class, 'store'])->name('signup');

//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'checkLogin'])->name('checkData');

//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//
//Route::get('/admin', [LoginController::class, 'admin_dash'])->name('admin_dashboard');
Route::get('/home', [LoginController::class, 'home'])->middleware("auth")->name('home');
Route::post('/attend', [UserController::class, 'attended_at'])->name('attend');
Route::post('/left', [UserController::class, 'left_at'])->name('left');


Route::post('/report', [UserController::class, 'report'])->name('report');



Route::get('/add_permission', [AdminController::class, 'add_permission'])->name('add_permission');
Route::get('/add_role_page', [AdminController::class, 'add_role_page'])->name('add_role_page');
Route::get('/add_new_user', [AdminController::class, 'add_new_user'])->name('add_new_user');

Route::get('/show_report', [AdminController::class, 'show_report'])->name('show_report');

Route::post('/store_permission', [AdminController::class, 'store_permission'])->name('store_permission');

Route::post('/add_role', [AdminController::class, 'add_role'])->name('add_role');
Route::post('/assign_role_to_user', [AdminController::class, 'assign_role_to_user'])->name('assign_role_to_user');
