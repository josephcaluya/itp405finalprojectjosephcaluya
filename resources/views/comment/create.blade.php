@extends('generalLayout')

@section('title', 'Add Comment')

@section('main')
    <h1>Add Comment for {{ $cafe->name }}</h1>
    <form action="{{ route('comment.store', ['cafe_id' => $cafe->id]) }}" method="POST">
        @csrf
        <div class="py-3">
            <label for="body" class="form-label">Body</label>
            <input type="text" name="body" id="body" class="form-control" value="{{ old('body') }}">
            @error('body')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save Comment
        </button>
    </form>
@endsection