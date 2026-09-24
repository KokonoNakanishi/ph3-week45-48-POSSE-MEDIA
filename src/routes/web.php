<?php
// ログイン機能
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
// 記事等移行機能
use App\Http\Controllers\PostController;


// ログイン画面を表示、ログイン処理、ログアウト
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// 記事一覧(トップページ)
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// ログインしている人だけが使えるルート
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// 記事詳細(必ず /posts/create より後に書く)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 詳細画面
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});