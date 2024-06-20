<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'admin'])->name('main.admin');
        Route::get('/admin/data_kategori', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/admin/data_user', [UserController::class, 'index'])->name('pengguna.index');
        Route::post('/admin/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::put('/admin/pengguna/{id}', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/admin/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');

        Route::get('/admin/data_barang', [BarangController::class, 'index'])->name('barang.index');
        Route::post('/admin/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::put('/admin/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/admin/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Gudang routes
    Route::middleware(['role:gudang'])->group(function () {
        Route::get('/gudang', [DashboardController::class, 'gudang'])->name('main.gudang');
        Route::get('/gudang/data_barang_masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
        Route::get('/gudang/create_barang_masuk', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
        Route::post('/gudang/barang_masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
        Route::get('/gudang/laporan_masuk', [LaporController::class, 'masuk'])->name('lapor.masuk');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('loginn', [LoginController::class, 'login'])->name('login.custom');

// Redirect routes for dashboards
Route::get('admin/dashboard', function () {
    return redirect()->route('main.admin');
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);

Route::get('gudang/dashboard', function () {
    return redirect()->route('main.gudang');
})->name('gudang.dashboard')->middleware(['auth', 'role:gudang']);
