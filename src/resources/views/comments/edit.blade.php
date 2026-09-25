@extends('layouts.app')

@section('title', 'コメントを編集 | POSSE MEDIA')

@section('content')
    <a href="{{ route('posts.show', $comment->post_id) }}"
        class="inline-flex items-center gap-1 mb-4 text-sm text-cyan-900 hover:underline">
        ← 記事に戻る
    </a>

    <h1 class="text-2xl font-bold mb-8">コメントを編集</h1>

    <form method="POST" action="{{ route('comments.update', $comment) }}"
            class="bg-white border border-cyan-600 rounded-xl shadow-sm p-8 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <textarea name="body" rows="5"
                        class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">{{ old('body', $comment->body) }}</textarea>
            @error('body')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-cyan-900 py-2.5 text-white font-medium hover:bg-cyan-700 transition">
            更新する
        </button>
    </form>
@endsection