<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\BrandController;
use App\Http\Controllers\Settings\WarnaController;
use App\Http\Controllers\Settings\SatuanController;
use App\Http\Controllers\Settings\VendorController;
use App\Http\Controllers\Produksi\ProduksiController;
use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Settings\PengrajinController;
use App\Http\Controllers\Warehouse\AssemblyController;
use App\Http\Controllers\Warehouse\BahanBakuController;
use App\Http\Controllers\Warehouse\ProductStockController;
use App\Http\Controllers\Purchase\OrderBahanBakuController;
use App\Http\Controllers\Warehouse\StokBahanBakuController;
use App\Http\Controllers\Settings\KategoriProductController;
use App\Http\Controllers\Settings\GudangPenyimpananController;
use App\Http\Controllers\Warehouse\TransaksiBahanBakuController;
use App\Http\Controllers\Warehouse\VerifikasiBahanBakuController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->resource('/profile', ProfileController::class);

//admin
Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'role:1'])->group(function () {
    Route::resource('/user', UserController::class);
});

//owner
Route::prefix('owner')->middleware(['auth:sanctum', 'verified', 'role:2'])->group(function () {
    Route::resource('/product', ProductController::class);
    Route::resource('/product-stock', ProductStockController::class);
    Route::resource('/produksi', ProduksiController::class);
    Route::resource('/order-bahan-baku', OrderBahanBakuController::class);
    Route::resource('/assembly', AssemblyController::class);
});

//accounting
Route::prefix('accounting')->middleware(['auth:sanctum', 'verified', 'role:3'])->group(function () {
    Route::resource('/order-bahan-baku', OrderBahanBakuController::class);
    Route::resource('/produksi', ProduksiController::class);
});

//production
Route::prefix('production')->middleware(['auth:sanctum', 'verified', 'role:4'])->group(function () {
});

//qc
Route::prefix('qc')->middleware(['auth:sanctum', 'verified', 'role:5'])->group(function () {
});

// warehouse
Route::prefix('warehouse')->middleware(['auth:sanctum', 'verified', 'role:6'])->group(function () {
    Route::resource('/product', ProductController::class);
    Route::resource('/stok-product', ProductStockController::class);
    Route::resource('/bahan-baku', BahanBakuController::class);
    Route::resource('/stok-bahan-baku', StokBahanBakuController::class);
    Route::resource('/transaksi-bahan-baku', TransaksiBahanBakuController::class);
    Route::resource('/order-bahan-baku', OrderBahanBakuController::class);
    Route::resource('/assembly', AssemblyController::class);
    Route::resource('/verifikasi-bahan-baku', VerifikasiBahanBakuController::class);
    Route::resource('/produksi', ProduksiController::class);

    Route::prefix('setting')->group(function () {
        Route::resource('/gudang-penyimpanan', GudangPenyimpananController::class);
        Route::resource('/kategori-produk', KategoriProductController::class);
        Route::resource('/kategori', KategoriProductController::class);
        Route::resource('/brand', BrandController::class);
        Route::resource('/satuan', SatuanController::class);
        Route::resource('/satuan', SatuanController::class);
        Route::resource('/vendor', VendorController::class);
        Route::resource('/warna', WarnaController::class);
        Route::resource('/pengrajin', PengrajinController::class);
    });
});
