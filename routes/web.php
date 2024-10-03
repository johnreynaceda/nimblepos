<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Cashier;
use App\Http\Middleware\CheckActive;
use App\Http\Middleware\Manager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    switch (auth()->user()->user_type) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'manager':
            return redirect()->route('manager.dashboard');
           
        case 'cashier':
            return redirect()->route('cashier.dashboard');
            

        default:
            # code...
            break;
    }
})->middleware(['auth', 'verified'])->name('dashboard');

//admin
Route::prefix('administrator')->middleware(['auth', 'verified', Admin::class, CheckActive::class])->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/POS', function () {
        return view('admin.pos');
    })->name('admin.pos');
    Route::get('/category', function () {
        return view('admin.category');
    })->name('admin.category');
    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');
    Route::get('/products/create', function () {
        return view('admin.create-product');
    })->name('admin.products.create');
    Route::get('/products/edit/{id}', function () {
        return view('admin.edit-product');
    })->name('admin.products.edit');
    Route::get('/products/create', function () {
        return view('admin.create-product');
    })->name('admin.products.create');
    Route::get('/inventory', function () {
        return view('admin.inventory');
    })->name('admin.inventory');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
    Route::get('/inventory/batch/{id}', function () {
        return view('admin.batch');
    })->name('admin.batch');
    Route::get('/stock-categories', function () {
        return view('admin.stock-categories');
    })->name('admin.stock-categories');
    Route::get('/summary-report', function () {
        return view('admin.report');
    })->name('admin.report');
});


//manager routes
Route::prefix('manager')->middleware(['auth', 'verified', Manager::class, CheckActive::class])->group(function(){
    Route::get('/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');
    Route::get('/inventory', function () {
        return view('manager.inventory');
    })->name('manager.inventory');

    Route::get('/inventory/batch/{id}', function () {
        return view('manager.batch');
    })->name('manager.batch');

    Route::get('/stock-categories', function () {
        return view('manager.stock-categories');
    })->name('manager.stock-categories');
});

Route::prefix('cashier')->middleware(['auth', 'verified', Cashier::class, CheckActive::class])->group(function(){
    Route::get('/pos', function () {
        return view('cashier.dashboard');
    })->name('cashier.dashboard');
   
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
