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
    <h1 class="pt-5">{{ $cafe->name }}</h1>
    <div class="py-3 text-center"><img src="{{ $cafe->image }}" alt="{{ $cafe->name }}" width="400" height="400" class="rounded"></div>
    <div class="py-3"><h6>Location: {{$cafe->address}}</h6></div>
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
    <div class="py-5 text-center"><form action="{{ route('favorite.store', ['cafe_id' => $cafe->id]) }}" method="POST">
        @csrf
        @method('POST')
        <button type="submit">
            Add cafe to favorites
        </button>
    </form></div>
    <div class="py-3">
        <h4>Reviews:</h4>
        @foreach ($reviews as $review)
            <div class="py-3">
                <h6>{{ $review->user->name }}</h6>
                <p><strong>{{ $review->stars }} out of 5 stars</strong></p>
                <p>{{ $review->body }}</p>
            </div>
        @endforeach
        <div class="pt-3 text-center"><form action="{{ route('review.create', ['cafe_id' => $cafe->id]) }}"><button type="submit">Add a review</button></form></div>
    </div>
    <div class="py-3">
        <h4>Comments:</h4>
        @foreach ($comments as $comment)
            <div class="py-3">
                <h6>{{ $comment->user->name }}</h6>
                <p><strong>{{ $comment->updated_at->format('F j, Y g:i A') }}</strong></p>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
        <div class="text-center"><form action="{{ route('comment.create', ['cafe_id' => $cafe->id]) }}"><button type="submit">Add a comment</button></form></div>
    </div>
    <div class="py-5 text-center"><form action="{{ route('cafe.edit', ['id' => $cafe->id]) }}">
        @csrf
        <button type="submit" class="btn btn-warning">
            Edit Cafe
        </button>
    </form></div>
    <div class="pb-3 text-center"><form action="{{ route('cafe.delete', ['id' => $cafe->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            Delete Cafe
        </button>
    </form></div>

@endsection