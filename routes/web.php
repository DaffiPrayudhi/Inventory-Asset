<?php

use App\Http\Controllers\PartMasukController;
use App\Http\Controllers\PartKeluarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\HargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\NewDataController;

Route::get('/', function () {
    return redirect('/login');
});


Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');

Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('/spareparts-data', [SparepartController::class, 'getSpareparts'])->name('spareparts.data');
    Route::get('/dashboard', [SparepartController::class,'index'])->name('dashboard');
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //import excel
    Route::get('/import', function() {
        return view('pemindahan.import'); 
    })->name('spareparts.import.view');
    Route::get('/importact', function() {
        return view('pemindahan.importact'); 
    })->name('spareparts.importact.view');
    Route::get('/import/data', [DataController::class, 'getSpareparts'])->name('spareparts.table');
    Route::get('/importact/data', [DataController::class, 'getSparepartsAct'])->name('spareparts.act.table');
    Route::post('/import', [SparepartController::class, 'import'])->name('spareparts.import');
    Route::post('/importact', [SparepartController::class, 'importact'])->name('spareparts.importact');
    
    //folder data komponen
    Route::resource('/data', DataController::class);

    //folder data komponen baru
    Route::prefix('data/new')->group(function () {
        Route::get('/create', [NewDataController::class, 'create'])->name('data.new.create');
        Route::post('/store', [NewDataController::class, 'store'])->name('data.new.store');
    });

    //input part masuk
    Route::resource('/partmasuk', PartMasukController::class);
    //input part keluar
    Route::resource('/partkeluar', PartKeluarController::class);
    //input stock part
    Route::resource('/stock', StockController::class);
    //input harga part
    Route::resource('/harga', HargaController::class);
    
    //fungsi filter
    Route::get('/data/no-stations/{line}', [DataController::class, 'getNoStationsByLine'])->name('data.no-stations');
    Route::get('/data/nama-stations/{line}', [DataController::class, 'getNamaStationsByLine'])->name('data.nama-stations');
    Route::get('/data/search-nama-barang/{term}', [DataController::class, 'searchNamaBarang'])->name('data.search-nama-barang');
});


require __DIR__.'/auth.php';

