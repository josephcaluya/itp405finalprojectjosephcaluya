@extends('generalLayout')

@section('title', 'Favorite Cafes')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="py-3">Favorite Cafes</h1>
    @if ($favoriteCount === 0)
        <div class="pb-3"><h3>No cafes have been favorited yet! Add one by going to a cafe's page.</h3></div>
        <div>
            <form action="{{ route('cafe.index') }}">
                <button type="submit">
                    Visit List of Cafes
                </button>
            </form>
        </div>
    @else
        <div class="row row-cols-3">
            @foreach ($favorites as $favorite)
                <div class="col d-flex flex-column justify-content-evenly">
                    <div><h4 class="text-center">{{ $favorite->cafe->name }}</h4></div>
                    <div class="text-center"><img src="{{ $favorite->cafe->image }}" alt="{{ $favorite->cafe->name }}" width="200" height="200" class="img-thumbnail"></div>
                    <div class="text-center"><p><strong>Favorited At: {{ $favorite->created_at->format('F j, Y g:i A') }}</strong></p></div>
                    <div class="py-3 text-center">
                        <form action="{{ route('cafe.show', ['id' => $favorite->cafe->id]) }}">
                            <button type="submit" class="btn btn-primary">
                                View Details
                            </button>
                        </form>
                    </div>
                    <div class="text-center">
                        <form action="{{ route('favorite.delete', ['id' => $favorite->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Remove from Favorites
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection