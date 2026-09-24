@extends('layouts.app')

@section('title', '記事を編集 | POSSE MEDIA')

@section('content')
    {{-- ★ 戻り先は詳細画面 --}}
    <a href="{{ route('posts.show', $post) }}"
        class="inline-flex items-center gap-1 mb-4 text-sm text-cyan-900 hover:underline">
        ← 記事に戻る
    </a>

    <h1 class="text-2xl font-bold mb-8">記事を編集</h1>

    {{-- ★ 送信先は update --}}
    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data"
            class="bg-white border border-cyan-600 rounded-xl shadow-sm p-8 space-y-6">
        @csrf
        @method('PUT') {{-- ★ 「実は PUT です」と伝える --}}

        <div>
            <label for="title" class="block text-sm font-medium mb-1.5">タイトル</label>
            {{-- ★ 初期値は今の記事の内容 --}}
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">
            @error('title')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="body" class="block text-sm font-medium mb-1.5">詳細</label>
            <textarea name="body" id="body" rows="8"
                        class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium mb-1.5">画像</label>
            {{-- ★ 今の画像をプレビュー --}}
            <img src="{{ asset('storage/' . $post->image_path) }}" alt=""
                    class="mb-3 w-40 h-28 object-cover rounded-lg">
            <input type="file" name="image" id="image" accept="image/*"
                    class="block w-full text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-cyan-300 file:px-4 file:py-2 hover:file:bg-cyan-600">
            <p class="mt-1.5 text-xs text-gray-500">※ 変更しない場合は選択不要です</p>
            @error('image')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-cyan-900 py-2.5 text-white font-medium hover:bg-cyan-700 transition">
            更新する
        </button>
    </form>
@endsection