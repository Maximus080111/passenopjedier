<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = App\Models\Post::all();
    return view('dashboard', ['posts' => $posts]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// Route::get('/admin', function () {
//     if (auth()->user()->is_admin) {
//         return view('admin', ['users' => App\Models\User::all(), 'posts' => App\Models\Post::all()]);
//     } else {
//         abort(403, 'Unauthorized');
//     }
// })->middleware(['auth', 'verified'])->name('admin');

// Route::resource('admin', UserController::class)
//     ->only(['edit', 'update', 'index'])
//     ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin/{user}/block', [UserController::class, 'block'])->name('admin.block');
    Route::get('/admin/{user}/admin', [UserController::class, 'admin'])->name('admin.admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
