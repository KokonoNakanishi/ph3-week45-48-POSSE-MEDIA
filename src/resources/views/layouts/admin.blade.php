<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理画面 | POSSE MEDIA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-gray-900">
    <header class="bg-slate-800 text-white">
        <div class="max-w-5xl mx-auto px-4 h-14 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span class="font-bold tracking-wide">POSSE MEDIA 管理画面</span>
                @auth('admin')
                    <nav class="flex gap-4 text-sm">
                        <a href="{{ route('admin.admins.index') }}" class="hover:underline">管理者一覧</a>
                    </nav>
                @endauth
            </div>
            @auth('admin')
                <div class="flex items-center gap-4 text-sm">
                    <span>{{ auth('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="text-slate-300 hover:text-white">ログアウト</button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>