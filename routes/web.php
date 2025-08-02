
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// rutas principales 
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

// rutas para el administrador
Route::middleware(['auth'])->prefix('jaal-4zlo-panel')->group(function () { // ruta para acceder al panel de login
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
    Route::get('/productos-panel', function() {
        $productos = \App\Models\Producto::orderByDesc('id')->paginate(7);
        return view('admin.productos', compact('productos'));
    })->name('admin.productos.panel');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
