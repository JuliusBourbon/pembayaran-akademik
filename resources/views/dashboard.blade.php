<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body @include('navbar')>
    @yield('content')
    <h1 class="text-center">Dashboard</h1>
    <p class="italic text-center">"Tetap bekerja walaupun gaji bercanda"</p><br>
    <p class="text-center"">gatau si tampilin apa aja disini</p>
</body>
</html>