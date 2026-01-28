<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 h-screen flex items-center justify-center">
    <div class="w-full max-w-[30%] bg-white px-6 py-20 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-center text-slate-900 mb-15">Portal Mahasiswa</h2>
        
        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/mahasiswa/login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700">No. Registrasi</label>
                <input type="text" name="no_reg" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border" required>
                <p class="text-xs text-red-500 mt-1">*Gunakan No. Reg sebagai password jika belum lunas.</p>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Masuk</button>
        </form>
        
       
    </div>
</body>
</html>