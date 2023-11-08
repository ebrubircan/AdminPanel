<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{AuthController,ProfileController,UserController,LoginController};


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/register',[AuthController::class, 'getRegister'])->name('getRegister');
Route::post('/admin/register',[AuthController::class, 'postRegister'])->name('postRegister');

Route::group(['middleware'=>'notLoggedIn'],function () {
    Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('postLogin');
});

Route::group(['middleware'=>'disable_back_btn'],function() {
    Route::group(['middleware' => ['admin_auth']], function () {
        Route::get('/admin/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('logout');
    });
});

Route::group(['middleware'=>'checkPassword'],function () {
    Route::get('/create-password', [LoginController::class, 'showForm'])->name('create-password');
    Route::post('/save-password', [LoginController::class, 'savePassword'])->name('save-password');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
});

Route::middleware('admin')->group(function () {
    Route::prefix('users')->group(function () {
        //tüm rotaların users'la başlayacağını belirtmek için prefix kullandık
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::get('add', [UserController::class, 'add'])->name('users.add');
        Route::post('save', [UserController::class, 'save'])->name('users.save');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });
});

