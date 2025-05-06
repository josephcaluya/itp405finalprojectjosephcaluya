@extends('generalLayout')

@section('title') 
    Edit Drink: {{ $drink->name }}
@endsection

@section('main')
    <h1>Edit Drink: {{ $drink->name }}</h1>
    <form action="{{ route('drink.update', ['id' => $drink->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="py-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $drink->name) }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $drink->price) }}">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="cafe" class="form-label">Cafe</label>
            <select name="cafe" id="cafe" class="form-select">
                <option value="{{ $drink->cafe->id }}">{{ $drink->cafe->name }}</option>
                @foreach($cafes as $cafe)
                    <option 
                        value="{{ $cafe->id }}"
                        {{ (string) $cafe->id === old('cafe') ? "selected" : "" }}
                    >
                        {{ $cafe->name }}
                    </option>
                @endforeach
            </select>
            @error('cafe')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $drink->image) }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save Drink
        </button>
    </form>
    <form action="{{ route('drink.delete', ['id' => $drink->id]) }}" class="text-center" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete Drink
        </button>
    </form>
@endsection