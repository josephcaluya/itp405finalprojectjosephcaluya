<?php

namespace App\Http\Controllers;
use App\Models\Cafe;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Drink;

use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function index()
    {
        $cafes = Cafe::orderBy('name', 'asc')->get();
        return view('cafe.index', [
            'cafes' => $cafes,
            'cafeCount' => count($cafes),
        ]);
    }

    public function show($id)
    {
        $cafe = Cafe::find($id);
        $reviews = Review::with(['user'])
            ->where('cafe_id', '=', $id)
            ->get();
        $comments = Comment::with(['user'])
            ->where('cafe_id', '=', $id)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $drinks = Drink::where('cafe_id', '=', $id)->get();
        return view('cafe.show', [
            'cafe' => $cafe,
            'reviews' => $reviews,
            'comments' => $comments,
            'drinks' => $drinks,
        ]);
    }

    public function create()
    {
        return view('cafe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|ends_with:St,Ave,Rd,Blvd,Dr,Pl',
            'image' => 'required|url',
        ]);

        $cafe = new Cafe();
        $cafe->name = $request->input('name');
        $cafe->address = $request->input('address');
        $cafe->image = $request->input('image');
        $cafe->save();

        return redirect()
            ->route('cafe.index')
            ->with('success', "Successfully added {$cafe->name}");
    }

    public function edit($id)
    {
        $cafe = Cafe::find($id);
        return view('cafe.edit', [
            'cafe' => $cafe,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|ends_with:St,Ave,Rd,Blvd,Dr,Pl',
            'image' => 'required|url',
        ]);

        $cafe = Cafe::find($id);
        $cafe->name = $request->input('name');
        $cafe->address = $request->input('address');
        $cafe->image = $request->input('image');
        $cafe->save();

        return redirect()
            ->route('cafe.index')
            ->with('success', "Successfully updated {$cafe->name}");
    }

    public function delete($id)
    {
        $cafe = Cafe::find($id);
        $name = $cafe->name;
        $cafe->delete();
        return redirect()
            ->route('cafe.index')
            ->with('success', "Successfully deleted {$name}");
    }
}
