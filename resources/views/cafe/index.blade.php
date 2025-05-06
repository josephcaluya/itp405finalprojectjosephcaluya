@extends('generalLayout')

@section('title', 'List of Cafes')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="py-3">List of Cafes</h1>
    @if ($cafeCount === 0)
        <div><h3>No cafes have been added yet! Add one by clicking on the button below.</h3></div>
        <div class="pt-3"><form action="{{ route('cafe.create') }}" method="get"><button type="submit">Add a cafe here!</button></form></div>
    @else
        <div class="row row-cols-3">
            @foreach ($cafes as $cafe)
                <div class="col d-flex flex-column justify-content-evenly">
                    <div><h4 class="text-center">{{ $cafe->name }}</h4></div>
                    <div class="py-3 text-center"><img src="{{ $cafe->image }}" alt="{{ $cafe->name }}" width="200" height="200" class="rounded"></div>
                    <div class="text-center"><form action="{{ route('cafe.show', ['id' => $cafe->id]) }}" method="get"><button type="submit">View Details</button></form></div>
                </div>
            @endforeach
        </div>
    @endif
@endsection