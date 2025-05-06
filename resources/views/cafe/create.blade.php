@extends('generalLayout')

@section('title', 'Add Cafe')

@section('main')
    <h1>Add Cafe</h1>
    <form action="{{ route('cafe.store') }}" method="POST">
        @csrf
        <div class="py-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image') }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
@endsection