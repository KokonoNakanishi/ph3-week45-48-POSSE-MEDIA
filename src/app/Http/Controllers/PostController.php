<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// 削除・編集画面・更新
// Gate → ポリシーを使って「この操作をしていいか」を判定する
// Storage → 保存した画像ファイルを操作する(更新時に古い画像を消すのに使う)
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

        // ④ 一覧に戻して、完了メッセージを出す
            return redirect()->route('posts.index')->with('status', '記事を投稿しました。');
                }
        // 記事一覧　with('user')->　これがイーガーローディング！これでN+1問題対策[まとめて1回で取ってくるから]
            public function index()
                {
                    $posts = Post::with('user')->latest()->paginate(10);
                    return view('posts.index', compact('posts'));
                }
        // 記事詳細
        // ルートモデルバインディング：そのIDの記事を自動でDBから探して $post に入れてくれる
            public function show(Post $post)
                {
                    $post->load('user');
                    return view('posts.show', compact('post'));
                }
        // 記事削除(論理削除)
            public function destroy(Post $post)
                {
                    Gate::authorize('delete', $post);
                    $post->delete();
                    return redirect()->route('posts.index')->with('status', '記事を削除しました。');
                }
        // 編集画面を表示
            public function edit(Post $post)
                {
                    Gate::authorize('update', $post);
                    return view('posts.edit', compact('post'));
                }
        // 記事更新
            public function update(Request $request, Post $post)
            {
                Gate::authorize('update', $post);
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'body'  => ['required', 'string'],
                    'image' => ['nullable', 'image', 'max:2048'],
        ]);

            $data = [
                'title' => $validated['title'],
                'body'  => $validated['body'],
            ];

            // 新しい画像が選ばれたときだけ差し替える
                if ($request->hasFile('image')) {
                    $newPath = $request->file('image')->store('posts', 'public');
                    Storage::disk('public')->delete($post->image_path);
                    $data['image_path'] = $newPath;
            }

            $post->update($data);
                return redirect()->route('posts.show', $post)->with('status', '記事を更新しました。');
            }
}