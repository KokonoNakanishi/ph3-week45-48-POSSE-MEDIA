@extends('layouts.app')

@section('title', $post->title . ' | POSSE MEDIA')

@section('content')
    <a href="{{ route('posts.index') }}"
        class="inline-flex items-center gap-1 mb-4 text-sm text-cyan-900 hover:underline">
        ← 記事一覧に戻る
    </a>

    <article class="bg-white border border-cyan-600 rounded-xl overflow-hidden">
        <img src="{{ asset('storage/' . $post->image_path) }}" alt=""
                class="w-full max-h-96 object-cover">

        <div class="p-8">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <p class="mt-2 text-sm text-gray-500">
                {{ $post->user->name }} ・ {{ $post->created_at->format('Y/m/d H:i') }}
            </p>

            <div class="mt-6 leading-relaxed whitespace-pre-wrap">{{ $post->body }}</div>

            {{-- 投稿者本人にだけボタンを表示 --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex gap-3 p-5">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                        class="rounded-lg border border-cyan-600 px-4 py-2 text-sm font-medium hover:bg-cyan-50 transition">
                        編集
                    </a>
                @endcan

                @can('delete', $post)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                            onsubmit="return confirm('本当に削除しますか?')">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-lg border border-red-600 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition">
                            削除
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </article>
        {{-- コメント --}}
    <section class="mt-10">
        <h2 class="text-lg font-bold mb-4">コメント({{ $post->comments->count() }})</h2>

        <div class="space-y-3">
            @forelse ($post->comments as $comment)
                <div class="bg-white border border-cyan-600 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium">{{ $comment->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $comment->created_at->format('Y/m/d H:i') }}</p>
                    </div>
                    <p class="mt-2 text-sm whitespace-pre-wrap">{{ $comment->body }}</p>

                    <div class="mt-3 flex gap-3 text-xs">
                        @can('update', $comment)
                            <a href="{{ route('comments.edit', $comment) }}" class="text-cyan-900 hover:underline">編集</a>
                        @endcan
                        @can('delete', $comment)
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}"
                                    onsubmit="return confirm('コメントを削除しますか?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">削除</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">まだコメントはありません。</p>
            @endforelse
        </div>

        {{-- コメント投稿フォーム(ログイン中のみ) --}}
        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-6">
                @csrf
                <textarea name="body" rows="3" placeholder="コメントを書く"
                            class="w-full rounded-lg border border-cyan-600 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-900">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="submit"
                        class="mt-3 rounded-lg bg-cyan-900 px-4 py-2 text-sm text-white font-medium hover:bg-cyan-700 transition">
                    コメントする
                </button>
            </form>
        @else
            <p class="mt-6 text-sm text-gray-500">
                コメントするには<a href="{{ route('login') }}" class="text-cyan-900 hover:underline">ログイン</a>してください。
            </p>
        @endauth
    </section>
@endsection