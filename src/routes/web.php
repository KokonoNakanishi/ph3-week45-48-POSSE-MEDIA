<?php
// ログイン機能
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
// 記事等移行機能
use App\Http\Controllers\PostController;

// 動作確認用(あとで記事一覧に置き換える)
Route::get('/', function () {
    return auth()->check()
        ? 'ログイン中:' . auth()->user()->name
        : '未ログイン';
});

// ① ログイン画面を表示 ② ログイン処理 ③ ログアウト
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// ログインしている人だけが使えるルート
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});