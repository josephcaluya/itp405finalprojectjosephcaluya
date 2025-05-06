<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Cafe;
use Auth;

class ReviewController extends Controller
{
    public function create($cafe_id)
    {
        $cafe = Cafe::find($cafe_id);
        return view('review.create', [
            'cafe' => $cafe,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'stars' => 'required|numeric',
            'body' => 'required|string|min:10',
        ]);

        $review = Review::find($id);
        $review->stars = $request->input('stars');
        $review->body = $request->input('body');
        $review->save();

        return redirect()
            ->route('cafe.show', ['id' => $review->cafe->id])
            ->with('success', "Successfully updated review for {$review->cafe->name}");
    }
    public function delete($id)
    {
        $review = Review::find($id);
        $name = $review->cafe->name;
        $review->delete();
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully deleted review for {$name}");
    }
    public function edit($id)
    {
        $review = Review::find($id);
        
        return view('review.edit', [
            'review' => $review,
        ]);
    }
    public function store(Request $request, $cafe_id)
    {
        $request->validate([
            'stars' => 'required|numeric',
            'body' => 'required|string|min:10',
        ]);
        $cafe = Cafe::find($cafe_id);
        $review = new Review();
        $review->stars = $request->input('stars');
        $review->cafe_id = $cafe_id;
        $review->user_id = Auth::id();
        $review->body = $request->input('body');
        $review->save();

        return redirect()
            ->route('cafe.show', ['id' => $cafe_id])
            ->with('success', "Successfully created review for {$cafe->name}");
    }
}
