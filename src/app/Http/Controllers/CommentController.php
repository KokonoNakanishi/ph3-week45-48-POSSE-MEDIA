<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    // コメント投稿
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate(
            ['body' => ['required', 'string', 'max:1000']],
            [],
            ['body' => 'コメント']
        );

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $validated['body'],
        ]);

        return redirect()->route('posts.show', $post)->with('status', 'コメントしました。');
    }

    // コメント編集画面
    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    // コメント更新
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $validated = $request->validate(
            ['body' => ['required', 'string', 'max:1000']],
            [],
            ['body' => 'コメント']
        );

        $comment->update(['body' => $validated['body']]);

        return redirect()->route('posts.show', $comment->post_id)->with('status', 'コメントを更新しました。');
    }

    // コメント削除
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)->with('status', 'コメントを削除しました。');
    }
}