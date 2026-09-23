<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

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