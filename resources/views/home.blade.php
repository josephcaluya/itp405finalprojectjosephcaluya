@extends('generalLayout')

@section('title', 'Home Page')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-5">
        <h1 class="text-center">The Cafe Log | Home</h1>
        @if (Auth::check())
            <div class="py-3 d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-dark" type="button"><a href="{{ route('cafe.create') }}" class="link-secondary">Add Cafe</a></button>
                <button class="btn btn-outline-dark" type="button"><a href="{{ route('drink.create') }}" class="link-secondary">Add Drink</a></button>
            </div>
        @else
            <div class="py-3 d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-dark" type="button"><a href="{{ route('registration.index') }}" class="link-secondary">Register</a></button>
                <button class="btn btn-outline-dark" type="button"><a href="{{ route('login') }}" class="link-secondary">Login</a></button>
            </div>
        @endif
    </div>
@endsection