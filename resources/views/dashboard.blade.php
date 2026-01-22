<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body @include('navbar')>
    @yield('content')
    <h1>Dashboard</h1>
    
    <p>Halo, {{ session('username') }}</p>
    <p>Role: {{ session('role') }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>