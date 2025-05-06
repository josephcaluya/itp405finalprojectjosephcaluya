@extends('generalLayout')

@section('title')
    Edit Comment for {{ $comment->cafe->name }}
@endsection

@section('main')
    <h1>Edit Comment for {{ $comment->cafe->name }}</h1>
    <form action="{{ route('comment.update', ['id' => $comment->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="py-3">
            <label for="body" class="form-label">Body</label>
            <input type="text" name="body" id="body" class="form-control" value="{{ old('body', $comment->body) }}">
            @error('body')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save Comment
        </button>
    </form>
@endsection