<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .nav-link.active {
        font-weight: bold;
        color: #6f4e37 !important;
        border-bottom: 2px solid #6f4e37;
    }
    </style>
</head>
<body style="background-color:lavenderblush">
    <div class="container py-5">
        @if (session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <ul class="nav d-flex justify-content-between px-5 py-5" style="background-color: white">
            <li class="nav-item">
                <h3 class="text-center">The Cafe Log</h3>
            </li>
            <li class="nav-item">
                <a href="{{ route('cafe.home') }}" class="nav-link {{ request()->routeIs('cafe.home') ? 'active' : '' }}">Home</a>
            </li>
            @if (Auth::check())
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cafe.index') }}" class="nav-link {{ request()->routeIs('cafe.*') && !request()->routeIs('cafe.home') ? 'active' : '' }}">Cafes</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favorite.index') }}" class="nav-link {{ request()->routeIs('favorite.*') ? 'active' : '' }}">Favorites</a>
                </li>
                <li class="nav-item">
                    <form method="post" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
    
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('registration.index') }}" class="nav-link {{ request()->routeIs('registration.*') ? 'active' : '' }}">Register</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                </li>
            @endif
        </ul>
        @yield('main')
    </div>
</body>
</html>