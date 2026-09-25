<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // ユーザー一覧
    public function index()
    {
        $users = User::withCount('posts')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // ユーザー削除(論理削除)
    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            $user->posts()->delete(); // その人の記事をまとめて論理削除
            $user->delete();          // ユーザーを論理削除
        });

        return redirect()->route('admin.users.index')->with('status', 'ユーザーを削除しました。');
    }
}