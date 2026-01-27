<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru - Universitas Unggulan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-slate-900">
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5 text-2xl font-bold text-blue-600 tracking-tight">
                    Unikom<span class="text-yellow-400">Unggul</span>
                </a>
            </div>
            <div class="flex flex-1 justify-end">
                <a href="{{ url('/mahasiswa/login') }}" class="text-sm font-semibold leading-6 text-slate-900 hover:text-blue-600">
                    Login <span>&rarr;</span>
                </a>
            </div>
        </nav>
    </header>
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
            <div class="relative left-[calc(50%-11rem)] aspect-1155/678 -translate-x-1/2 rotate-30 bg-linear-to-tr from-yellow-300 to-blue-600 opacity-30 sm:left-[calc(50%-30rem)] sm:w-72.1875rem" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 text-center">
            {{-- @if(session('success'))
                <div class="mb-8 rounded-full bg-green-50 px-4 py-2 text-sm leading-6 text-green-600 ring-1 ring-inset ring-green-600/20">
                    {{ session('success') }}
                </div>
            @endif --}}
            <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl">
                Wujudkan Masa Depan<br>
                <span class="text-blue-600">Bersama Kami</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-slate-600">
                Pendaftaran Mahasiswa Baru Tahun Ajaran 2026/2027 telah dibuka. Bergabunglah dengan ribuan talenta muda lainnya dan kembangkan potensimu di sini.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <button onclick="openModal()" class="rounded-md cursor-pointer bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition transform hover:-translate-y-1">
                    Daftar Sekarang
                </button>
            </div>
        </div>
        
    </div>

    @include('pendaftaran')

    <footer class="bg-white border-t border-slate-100 py-12 text-center">
        <p class="text-slate-500 text-sm">© 2026 Universitas Komputer Indonesia. All rights reserved.</p>
    </footer>

    <script>
        const modal = document.getElementById('registrationModal');
        const body = document.body;

        function openModal() {
            modal.classList.remove('hidden');
            body.classList.add('overflow-hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
            body.classList.remove('overflow-hidden');
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>