<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Cafe;
use Auth;

class CommentController extends Controller
{
    public function create($cafe_id)
    {
        $cafe = Cafe::find($cafe_id);
        return view('comment.create', [
            'cafe' => $cafe,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|min:10',
        ]);

        $comment = Comment::find($id);
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()
            ->route('cafe.show', ['id' => $comment->cafe->id])
            ->with('success', "Successfully updated comment for {$comment->cafe->name}");

    }
    public function delete($id)
    {
        $comment = Comment::find($id);
        $name = $comment->cafe->name;
        $comment->delete();
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully deleted comment for {$name}");
    }
    public function edit($id)
    {
        $comment = Comment::find($id);
        
        return view('comment.edit', [
            'comment' => $comment,
        ]);
    }
    public function store(Request $request, $cafe_id)
    {
        $request->validate([
            'body' => 'required|string|min:10',
        ]);
        $cafe = Cafe::find($cafe_id);
        $comment = new Comment();
        $comment->cafe_id = $cafe_id;
        $comment->user_id = Auth::id();
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()
            ->route('cafe.show', ['id' => $cafe_id])
            ->with('success', "Successfully created comment for {$cafe->name}");
    }
}
