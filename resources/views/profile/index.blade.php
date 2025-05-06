@extends('generalLayout')

@section('title', 'Profile')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="py-3">Profile</h1>
    <h4>Hello, {{ $user->name }}!</h4>
    <h6>You like {{ $favoriteCount }} cafes. </h6>
    <h6>Your reviews:</h6>
    @if ($reviewCount === 0)
        <p>You have no reviews yet! Visit a cafe page to add a review.</p>
        <div class="pb-3"><form action="{{ route('cafe.index') }}" method="get"><button type="submit">Go to Cafe List Page</button></form></div>
    @else
        @foreach ($reviews as $review)
            <div class="py-3 d-flex flex-column">
                <div>
                    <p><strong>Review for: {{ $review->cafe->name }}</strong></p>
                    <p>{{ $review->body }}</p>
                </div>
                <div>
                    <div class="py-3">
                        <form action="{{ route('review.edit', ['id' => $review->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                Edit Review
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{ route('review.delete', ['id' => $review->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <h6 class="pt-3">Your comments:</h6>
    @if ($commentCount === 0)
        <p>You have no comments yet! Visit a cafe page to add a comment.</p>
        <div><form action="{{ route('cafe.index') }}" method="get"><button type="submit">Go to Cafe List Page</button></form></div>
    @else
        @foreach ($comments as $comment)
            <div class="py-3 d-flex flex-column">
                <div>
                    <p><strong>Comment for: {{ $comment->cafe->name }}</strong></p>
                    <p>{{ $comment->body }}</p>
                </div>
                <div>
                    <div class="py-3">
                        <form action="{{ route('comment.edit', ['id' => $comment->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                Edit Comment
                            </button>
                        </form>
                    </div>
                    <div>
                        <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection