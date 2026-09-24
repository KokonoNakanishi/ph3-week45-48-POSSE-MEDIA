<?php
// ログイン機能
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
// 記事等移行機能
use App\Http\Controllers\PostController;
// 管理者用ログイン機能
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;


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

// week47 管理者
Route::prefix('admin')->name('admin.')->group(function () {
    // 管理者ログイン(未ログインでも入れる)
    Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store']);

    // 管理者としてログインしている人だけ
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
        Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    });
});