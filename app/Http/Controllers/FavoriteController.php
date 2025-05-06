<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Cafe;
use Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['cafe'])
            ->where('user_id', '=', Auth::id())
            ->get();
        $favoriteCount = count($favorites);
        return view('favorite.index', [
            'favorites' => $favorites,
            'favoriteCount' => $favoriteCount,
        ]);
    }
    public function store(Request $request, $cafe_id)
    {
        $cafe = Cafe::find($cafe_id);
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->cafe_id = $cafe_id;
        $favorite->save();

        return redirect()
            ->route('favorite.index')
            ->with('success', "Successfully added {$cafe->name} to favorites");
    }
    public function delete($id)
    {
        $favorite = Favorite::find($id);
        $name = $favorite->cafe->name;
        $favorite->delete();
        return redirect()
            ->route('favorite.index')
            ->with('success', "Successfully deleted {$name} from favorites");
    }
}
