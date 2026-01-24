<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login</title>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border border-slate-200">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Sistem Pembayaran Akademik</h1>
            <p class="text-slate-500 text-sm mt-1">Universitas Komputer Indonesia</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="username" class="block text-slate-700 text-sm font-semibold mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Masukkan username" required autofocus>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-slate-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Masukkan kata sandi" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>