@extends('layouts.app')

@section('title', '記事を投稿 | POSSE MEDIA')

@section('content')
    <a href="{{ route('posts.index') }}"
            class="inline-flex items-center gap-1 mb-4 text-sm text-cyan-900 hover:underline">
            ← 記事一覧に戻る
    </a>
    <h1 class="text-2xl font-bold mb-8">記事を投稿</h1>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
            class="bg-white border border-cyan-600 rounded-xl shadow-sm p-8 space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium mb-1.5">タイトル</label>
            {{-- ★ 直前の入力 → 下書き → 空 の順で表示 --}}
            <input type="text" name="title" id="title" value="{{ old('title', $draft['title'] ?? '') }}"
                    class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">
            @error('title')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="body" class="block text-sm font-medium mb-1.5">詳細</label>
            {{-- ★ 同じく下書きを戻す --}}
            <textarea name="body" id="body" rows="8"
                        class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">{{ old('body', $draft['body'] ?? '') }}</textarea>
            @error('body')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium mb-1.5">画像</label>
            <input type="file" name="image" id="image" accept="image/*"
                    class="block w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-cyan-300 file:px-4 file:py-2 hover:file:bg-cyan-600">
            {{-- ★ 注意書き --}}
            <p class="mt-1.5 text-xs text-gray-500">※ 画像は下書きに保存されません</p>
            @error('image')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ★ ボタンを2つに(押したほうの value が action として送られる) --}}
        <div class="flex gap-3">
            <button type="submit" name="action" value="draft"
                    class="flex-1 rounded-lg border border-cyan-600 bg-white py-2.5 font-medium hover:bg-cyan-50 transition">
                下書き保存
            </button>
            <button type="submit" name="action" value="publish"
                    class="flex-1 rounded-lg bg-cyan-900 py-2.5 text-white font-medium hover:bg-cyan-700 transition">
                投稿する
            </button>
        </div>
    </form>
@endsection