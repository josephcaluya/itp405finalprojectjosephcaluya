<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function create()
    {
        $cafes = Cafe::orderBy('name', 'ASC')->get();
        return view('drink.create', [
            'cafes' => $cafes,
        ]);
    }
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'price' => 'required|decimal:2',
            'cafe' => 'required|exists:cafes,id',
            'image' => 'required|url',
       ]);
       $drink = new Drink();
       $drink->name = $request->input('name');
       $drink->price = $request->input('price');
       $drink->image = $request->input('image');
       $drink->cafe_id = $request->input('cafe');
       $drink->save();
       return redirect()
            ->route('drink.confirmation', ['id' => $drink->id])
            ->with('success', "Successfully added {$drink->name}");
    }
    public function edit($id)
    {
        $drink = Drink::find($id);
        $cafes = Cafe::orderBy('name', 'ASC')->get();
        return view('drink.edit', [
            'drink' => $drink,
            'cafes' => $cafes,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|decimal:2',
            'cafe' => 'required|exists:cafes,id',
            'image' => 'required|url',
       ]);
       $drink = Drink::find($id);
       $drink->name = $request->input('name');
       $drink->price = $request->input('price');
       $drink->image = $request->input('image');
       $drink->cafe_id = $request->input('cafe');
       $drink->save();
       return redirect()
            ->route('cafe.home')
            ->with('success', "Successfully updated {$drink->name}");
    }
    public function delete($id)
    {
        $drink = Drink::find($id);
        $name = $drink->name;
        $drink->delete();
        return redirect()
            ->route('cafe.index')
            ->with('success', "Successfully deleted {$name}");
    }
    public function confirmation($id)
    {
        return view('drink.confirmation', [
            'id' => $id,
        ]);
    }
}
