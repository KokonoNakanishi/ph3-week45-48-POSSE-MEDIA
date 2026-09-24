@extends('layouts.admin')

@section('title', '管理者ログイン | POSSE MEDIA')

@section('content')
    <div class="max-w-sm mx-auto">
        <h1 class="text-xl font-bold mb-6">管理者ログイン</h1>

        <form method="POST" action="{{ route('admin.login') }}"
                class="bg-white border border-slate-300 rounded-xl p-8 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium mb-1.5">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-700">
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1.5">パスワード</label>
                <input type="password" name="password" id="password"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-700">
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-slate-800 py-2.5 text-white font-medium hover:bg-slate-700 transition">
                ログイン
            </button>
        </form>
    </div>
@endsection