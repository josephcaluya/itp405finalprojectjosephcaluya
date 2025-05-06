@extends('generalLayout')

@section('title', 'Add Review')

@section('main')
    <h1>Add Review for {{ $cafe->name }}</h1>
    <form action="{{ route('review.store', ['cafe_id' => $cafe->id]) }}" method="POST">
        @csrf
        <div class="py-3">
            <label for="stars" class="form-label">How many stars would you rate your experience (1-5)?</label>
            <select name="stars" id="stars" class="form-select">
                <option value="">-- Select Number of Stars --</option>
                <option value="1" {{ 1 === old('stars') ? "selected" : "" }}>1</option>
                <option value="2" {{ 2 === old('stars') ? "selected" : "" }}>2</option>
                <option value="3" {{ 3 === old('stars') ? "selected" : "" }}>3</option>
                <option value="4" {{ 4 === old('stars') ? "selected" : "" }}>4</option>
                <option value="5" {{ 5 === old('stars') ? "selected" : "" }}>5</option>
            </select>
            @error('stars')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="py-3">
            <label for="body" class="form-label">Body</label>
            <input type="text" name="body" id="body" class="form-control" value="{{ old('body') }}">
            @error('body')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save Review
        </button>
    </form>
@endsection