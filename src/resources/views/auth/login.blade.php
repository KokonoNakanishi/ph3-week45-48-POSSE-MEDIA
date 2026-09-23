<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン | POSSE MEDIA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center px-4 text-gray-900">
    <div class="w-full max-w-sm">
        <h1 class="text-center text-2xl font-bold tracking-wide mb-8">POSSE MEDIA</h1>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
            <h2 class="text-lg font-semibold mb-6">ログイン</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-1.5">メールアドレス</label>
                    <input
                        type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900
                                @error('email') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1.5">パスワード</label>
                    <input
                        type="password" name="password" id="password"
                        class="w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-900
                                @error('password') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-gray-900 py-2.5 text-white font-medium hover:bg-gray-700 transition">
                    ログイン
                </button>
            </form>
        </div>
    </div>
</body>
</html>