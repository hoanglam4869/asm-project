<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

// Trang chủ (welcome page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);


// Routes cho đăng ký và đăng nhập
Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [AuthController::class, 'register']);

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login']);

// Trang chào mừng người dùng (sau khi đăng nhập)
Route::get('auth/welcome', function () {
    return view('auth.welcome');
})->middleware('auth')->name('welcome');

// Routes cho chỉnh sửa thông tin khách hàng
Route::get('customer/edit', [CustomerController::class, 'getCustomerInfo'])->middleware('auth')->name('edit.customer');
Route::put('customer/edit', [CustomerController::class, 'updateCustomerInfo'])->middleware('auth');

// Routes cho xóa người dùng
Route::delete('customer/delete', [AuthController::class, 'deleteUser'])->middleware('auth')->name('delete.user');

// Route để đăng xuất
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// Dashboard và các trang khác (nếu cần thiết)
Route::get('dashboard', function () {
    return view('dashboard'); // Đảm bảo bạn có trang dashboard.blade.php
})->middleware('auth')->name('dashboard');

Route::get('about', function () {
    return view('about'); // Đảm bảo bạn có trang about.blade.php
})->name('about');

use App\Http\Controllers\CategoryController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('category', CategoryController::class);
});

use App\Http\Controllers\ProductController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('product', ProductController::class);
});

// routes/web.php

use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
