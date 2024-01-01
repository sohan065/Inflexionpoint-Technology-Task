<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('user.login');
});

Route::resource('category', CategoryController::class);

Route::middleware(['admin'])->group(function () {
    Route::resource('product', ProductController::class);
});
Route::get('purchase/{product}', [ProductController::class, 'purchase'])->name('purchase');

Route::prefix('user')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});


Route::get('/import-export', [ProductController::class, 'importExportForm']);
Route::post('/import', [ProductController::class, 'import'])->name('import');
Route::get('/export', [ProductController::class, 'export'])->name('export');
