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
@endsection