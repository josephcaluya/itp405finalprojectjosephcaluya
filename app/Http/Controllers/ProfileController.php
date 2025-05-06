<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Favorite;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $reviews = Review::with(['cafe'])
            ->where('user_id', '=', $id)
            ->get();
        $comments = Comment::with(['cafe'])
            ->where('user_id', '=', $id)
            ->get();
        $favoriteCount = Favorite::where('user_id', '=', $id)->count();
        $reviewCount = count($reviews);
        $commentCount = count($comments);

        return view('profile.index', [
            'user' => Auth::user(),
            'reviews' => $reviews,
            'comments' => $comments,
            'favoriteCount' => $favoriteCount,
            'reviewCount' => $reviewCount,
            'commentCount' => $commentCount,
        ]);
    }
}
