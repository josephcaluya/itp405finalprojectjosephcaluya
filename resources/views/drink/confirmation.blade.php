@extends('generalLayout')

@section('title', 'Drink Added')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="py-3">Your drink has been successfully added.</h1>
    <div class="py-3">
        <form action="{{ route('drink.edit', ['id' => $id]) }}">
            @csrf
            <button type="submit">Edit Drink</button>
        </form>
    </div>
    <div>
        <form action="{{ route('drink.delete', ['id' => $id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button">Delete Drink</button></div>
@endsection