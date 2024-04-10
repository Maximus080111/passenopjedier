<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AanvraagController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PetProfileController;
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
    $posts = App\Models\Post::where('user_id', auth()->user()->id)->get();
    $aanvragen = App\Models\Aanvraag::whereIn('post_id', $posts->pluck('id')->toArray())->get();
    $users = App\Models\User::whereIn('id', $aanvragen->pluck('user_id')->toArray())->get();
    return view('dashboard', ['posts' => $posts, 'aanvragen' => $aanvragen, 'users' => $users]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'create'])
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

Route::middleware('auth')->group(function () {
    Route::get('/user/{user}', [UserProfileController::class, 'index'])->name('userProfile.index');
    Route::post('/user/{user}/upload', [UserProfileController::class, 'upload'])->name('userProfile.upload');
});

Route::middleware('auth')->group(function() {
    Route::get('/pet/{post}', [PetProfileController::class, 'index'])->name('petProfile.index');
    Route::post('/pet/{pet}/upload', [PetProfileController::class, 'upload'])->name('petProfile.upload');	
});

Route::middleware('auth')->group(function () {
    Route::get('/aanvraag/{post}', [AanvraagController::class, 'store'])->name('aanvraag.store');
    Route::get('aanvraag/{aanvraag}/{post}/edit', [AanvraagController::class, 'edit'])->name('aanvraag.edit');
    Route::get('aanvraag/{aanvraag}/destroy', [AanvraagController::class, 'destroy'])->name('aanvraag.destroy');
    Route::post('aanvraag/{post}/review', [AanvraagController::class, 'review'])->name('aanvraag.review');
});

require __DIR__.'/auth.php';
