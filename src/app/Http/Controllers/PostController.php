<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿フォームを表示
    public function create()
    {
        //  セッションから下書きを取り出す(なければ空の配列)
        $draft = session('post_draft', []);

        //  下書きをビューに渡す
        return view('posts.create', compact('draft'));
    }

    // 投稿処理
    public function store(Request $request)
    {
        //  下書き保存ボタンが押されたとき(バリデーションせずに保存して戻る)
        if ($request->input('action') === 'draft') {
            $request->session()->put('post_draft', $request->only('title', 'body'));
            return redirect()->route('posts.create')->with('status', '下書きを保存しました。');
        }

        // ① 入力チェック(ダメなら自動でフォームに戻る)
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        // ② 画像を保存して、保存場所(パス)を受け取る
        $path = $request->file('image')->store('posts', 'public');

        // ③ ログイン中のユーザーの記事として保存
        auth()->user()->posts()->create([
            'title'      => $validated['title'],
            'body'       => $validated['body'],
            'image_path' => $path,
        ]);

        // ★ 投稿できたので下書きを消す
        $request->session()->forget('post_draft');

        // ④ フォームに戻して、完了メッセージを出す
        return redirect()->route('posts.create')->with('status', '記事を投稿しました。');
    }
}