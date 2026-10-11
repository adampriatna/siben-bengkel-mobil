<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'mekanik') {
            return redirect()->route('mekanik.dashboard');
        }

        if ($role === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard');
        }

        abort(403, 'Role tidak dikenali.');
    })->name('dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        abort_unless(auth()->user()->role === 'admin', 403);

        return view('dashboard', [
            'roleTitle' => 'Administrator',
        ]);
    })->name('admin.dashboard');

    // Dashboard Mekanik
    Route::get('/mekanik/dashboard', function () {
        abort_unless(auth()->user()->role === 'mekanik', 403);

        return view('dashboard', [
            'roleTitle' => 'Mekanik',
        ]);
    })->name('mekanik.dashboard');

    // Dashboard Pelanggan
    Route::get('/pelanggan/dashboard', function () {
        abort_unless(auth()->user()->role === 'pelanggan', 403);

        return view('dashboard', [
            'roleTitle' => 'Pelanggan',
        ]);
    })->name('pelanggan.dashboard');

    // CRUD Pengguna: khusus Admin
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('users', UserManagementController::class)
            ->except(['show']);
    });

    // CRUD Sparepart: khusus Admin
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('spareparts', SparepartController::class)
            ->except(['show']);
    });
    
    // CRUD Supplier: khusus Admin
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('suppliers', SupplierController::class)
            ->except(['show']);
    });
    
    // Profil pengguna
    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');
});

require __DIR__.'/auth.php';
