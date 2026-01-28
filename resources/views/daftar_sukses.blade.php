<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 font-sans">
    @if($mhs)
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200">
            <div class="bg-green-600 px-6 py-3 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-500">
                    <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <h2 class="mt-4 text-2xl font-bold text-white">Pendaftaran Berhasil!</h2>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-4 m-6">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-red-700">
                            <strong class="font-bold">PENTING:</strong> Halaman ini hanya muncul 1x. Simpan data ini sekarang.
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-6">
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200 space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                        <span class="text-sm text-slate-500">Nama Pendaftar</span>
                        <span class="text-lg font-mono font-bold text-slate-900">{{ $mhs->nama_mhs }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                        <span class="text-sm text-slate-500">Username</span>
                        <span class="text-base font-medium text-slate-900">{{ $mhs->username }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                        <span class="text-sm text-slate-500">Password</span>
                        <span class="text-base font-medium text-slate-900">{{ $mhs->password ?? $mhs->no_reg }}</span>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 m-6">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-blue-700 text-center">
                                Gunakan akun ini pada halaman <a target="_blank" href="/mahasiswa/login" class="hover:underline font-bold">portal mahasiswa</a> untuk melihat informasi pembayaran
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3">
                    <button onclick="window.print()" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition shadow-md flex justify-center items-center gap-2">
                        Download Bukti Pendaftaran
                    </button>
                    <a href="{{ url('/') }}" class="flex-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold py-3 px-4 rounded-lg transition text-center">
                        Selesai
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="">
            <div class="p-8 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-6">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-slate-900 mb-2">Halaman Kadaluarsa/Tidak Valid</h2>
                
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    Halaman ini tidak tersedia atau sudah tidak dapat diakses.
                </p>

                <div class="p-4 mb-6">
                    <p class="text-slate-500 font-semibold">
                        Hubungi Bagian Administrasi Kampus untuk Informasi lebih lanjut.
                    </p>
                </div>

                <a href="{{ url('/') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition shadow-sm">
                    Kembali
                </a>
            </div>
        </div>

    @endif

</body>
</html>