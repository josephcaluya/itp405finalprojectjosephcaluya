@extends('generalLayout')

@section('title')
    Edit Cafe: {{ $cafe->name }}
@endsection

@section('main')
    <h1>Edit Cafe: {{ $cafe->name }}</h1>
    <form action="{{ route('cafe.update', ['id' => $cafe->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="py-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $cafe->name) }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $cafe->address) }}">
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $cafe->image) }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save Changes to Cafe
        </button>
    </form>
@endsection