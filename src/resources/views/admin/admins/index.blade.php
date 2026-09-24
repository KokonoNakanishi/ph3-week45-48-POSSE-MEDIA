@extends('layouts.admin')

@section('title', '管理者一覧 | POSSE MEDIA')

@section('content')
    <h1 class="text-2xl font-bold mb-6">管理者一覧</h1>

    <div class="bg-white border border-slate-300 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">名前</th>
                    <th class="px-4 py-3">メールアドレス</th>
                    <th class="px-4 py-3">登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">{{ $admin->id }}</td>
                        <td class="px-4 py-3">{{ $admin->name }}</td>
                        <td class="px-4 py-3">{{ $admin->email }}</td>
                        <td class="px-4 py-3">{{ $admin->created_at->format('Y/m/d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection