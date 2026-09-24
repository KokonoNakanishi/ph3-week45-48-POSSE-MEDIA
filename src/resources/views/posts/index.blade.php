@extends('layouts.app')

@section('title', '記事一覧 | POSSE MEDIA')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">記事一覧</h1>
        @auth
            <a href="{{ route('posts.create') }}"
                class="rounded-lg bg-cyan-900 px-4 py-2 text-sm text-white font-medium hover:bg-cyan-700 transition">
                記事を投稿
            </a>
        @endauth
    </div>

    @if ($posts->isEmpty())
        <p class="text-gray-500">まだ記事がありません。</p>
    @else
        <div class="space-y-4">
            @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post) }}"
                    class="flex gap-4 bg-white border border-cyan-600 rounded-xl p-4 hover:shadow-md transition">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt=""
                            class="w-32 h-24 object-cover rounded-lg shrink-0">
                    <div class="min-w-0">
                        <h2 class="font-bold text-lg truncate">{{ $post->title }}</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ Str::limit($post->body, 80) }}</p>
                        <p class="mt-2 text-xs text-gray-500">
                            {{ $post->user->name }} ・ {{ $post->created_at->format('Y/m/d H:i') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif
@endsection