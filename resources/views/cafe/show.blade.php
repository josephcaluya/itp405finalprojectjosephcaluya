@extends('generalLayout')

@section('title')
    {{ $cafe->name }}
@endsection

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="pt-3">{{ $cafe->name }}</h1>
    <div class="py-3"><img src="{{ $cafe->image }}" alt="{{ $cafe->name }}" width="400" height="400" class="rounded"></div>
    <h6>Location: {{$cafe->address}}</h6>
    <div>
        <h6 class="py-3">People have drunk:</h6>
        <div class="row row-cols-3">
            @foreach ($drinks as $drink)
                <div class="col d-flex flex-column justify-content-evenly">
                    <div><img src="{{ $drink->image }}" alt="{{ $drink->name }}" width="200" height="200" class="img-thumbnail"></div>
                    <div>{{ $drink->name }}: ${{ $drink->price }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="py-3"><form action="{{ route('favorite.store', ['cafe_id' => $cafe->id]) }}" method="POST">
        @csrf
        @method('POST')
        <button type="submit">
            Add to favorites
        </button>
    </form></div>
    <div class="py-3">
        <h6>Reviews:</h6>
        @foreach ($reviews as $review)
            <h6>{{ $review->user->name }}</h6>
            <p><strong>{{ $review->stars }} out of 5 stars</strong></p>
            <p>{{ $review->body }}</p>
        @endforeach
        <div class="pt-3"><form action="{{ route('review.create', ['cafe_id' => $cafe->id]) }}"><button type="submit">Add a review</button></form></div>
    </div>
    <div class="py-3">
        <h6>Comments:</h6>
        @foreach ($comments as $comment)
            <h6>{{ $comment->user->name }}</h6>
            <p><strong>{{ $comment->updated_at->format('F j, Y g:i A') }}</strong></p>
            <p>{{ $comment->body }}</p>
        @endforeach
        <div><form action="{{ route('comment.create', ['cafe_id' => $cafe->id]) }}"><button type="submit">Add a comment</button></form></div>
    </div>
    <div class="py-3"><form action="{{ route('cafe.edit', ['id' => $cafe->id]) }}">
        @csrf
        <button type="submit" class="btn btn-warning">
            Edit Cafe
        </button>
    </form></div>
    <div class="py-3"><form action="{{ route('cafe.delete', ['id' => $cafe->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete Cafe
        </button>
    </form></div>

@endsection