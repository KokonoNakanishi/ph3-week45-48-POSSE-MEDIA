@extends('layouts.admin')

@section('title', 'ユーザー一覧 | POSSE MEDIA')

@section('content')
    <h1 class="text-2xl font-bold mb-6">ユーザー一覧</h1>

    <div class="bg-white border border-slate-300 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">名前</th>
                    <th class="px-4 py-3">メールアドレス</th>
                    <th class="px-4 py-3">投稿数</th>
                    <th class="px-4 py-3">登録日</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->posts_count }}</td>
                        <td class="px-4 py-3">{{ $user->created_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('{{ $user->name }} さんを削除しますか?投稿も非表示になります。')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg border border-red-600 px-3 py-1.5 text-red-600 hover:bg-red-50 transition">
                                    削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection