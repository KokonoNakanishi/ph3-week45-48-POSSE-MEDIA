<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSSE MEDIA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-3xl mx-auto px-4 h-14 flex items-center justify-between">
            <a href="/" class="font-bold tracking-wide">POSSE MEDIA</a>
            @auth
                <div class="flex items-center gap-4 text-sm">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-500 hover:text-gray-900">ログアウト</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 py-10">
        @yield('content')
        @if (session('status'))
    <div class="m-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('status') }}
    </div>
        @endif
    </main>
</body>
</html>