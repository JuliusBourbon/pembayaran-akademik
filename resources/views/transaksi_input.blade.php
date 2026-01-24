<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pembayaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('navbar')
    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8 mt-16">
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">Input Transaksi Pembayaran</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl sticky top-24">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100 bg-slate-50 rounded-t-xl">
                        <h3 class="text-lg font-semibold text-slate-900">Informasi Mahasiswa</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-6"> 
                            <div>
                                <p class="text-sm font-medium text-slate-500">No. Registrasi</p>
                                <p class="mt-1 text-lg font-mono font-semibold text-slate-900">{{ $mhs->no_reg }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-slate-500">Nama Lengkap</p>
                                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $mhs->nama_mhs }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-slate-500">Program Studi</p>
                                <p class="mt-1 text-lg font-semibold text-slate-700">{{ $mhs->nama_prodi ?? $mhs->kode_prodi }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-slate-500">Status Akademik</p>
                                <p class="mt-1 pt-2">
                                    @if($mhs->nim)
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Aktif</span>
                                            <span class="text-xs text-slate-500 font-mono">{{ $mhs->nim }}</span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Calon Mahasiswa</span>
                                        <p class="text-xs font-semibold text-slate-400 mt-1">-</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100">
                        <h3 class="text-base font-semibold text-slate-900">Formulir Pembayaran</h3>
                    </div>
                    
                    <form action="{{ url('/transaksi/proses') }}" method="POST" class="px-4 py-6 sm:p-8" onsubmit="return confirm('Apakah data pembayaran sudah benar?');">
                        @csrf
                        <input type="hidden" name="no_reg" value="{{ $mhs->no_reg }}">
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-900">Jenis Pembayaran</label>
                                <div class="mt-2">
                                    <select name="jenis_biaya" class="block w-full rounded-md border-0 py-2.5 px-3 text-slate-500 shadow-sm ring-1 ring-inset ring-slate-300 sm:text-sm sm focus:ring-0">
                                        <option value="Registrasi" selected>Biaya Registrasi Awal / Daftar Ulang</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-900">Nominal Pembayaran</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <p class="text-slate-500 sm:text-sm">Rp</p>
                                    </div>
                                    <input type="number" name="nominal" id="nominal" required min="100000" class="block w-full rounded-md border-0 py-3 pl-10 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-lg sm font-mono font-bold" placeholder="0">
                                </div>
                                
                                <div class="rounded-md bg-blue-50 p-4 mt-3">
                                    <div class="flex">
                                        <div class="flex">
                                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1 md:flex md:justify-between">
                                            <p class="text-sm text-blue-700">Sistem otomatis memberikan NIM jika pembayaran <span class="font-bold">≥ Rp 5.000.000</span>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-900">Petugas</label>
                                <div class="mt-2">
                                    <input type="text" disabled value="{{ Session::get('username') }} ({{ Session::get('role') }})" class="block w-full rounded-md border-0 py-2 px-3 bg-slate-100 text-slate-500 shadow-sm ring-1 ring-inset ring-slate-300 sm:text-sm sm cursor-not-allowed">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex items-center justify-end gap-x-6 border-t border-slate-900/10 pt-6">
                            <a href="{{ url('/cari-mahasiswa') }}" class="text-sm font-semibold text-slate-900 hover:text-red-600">Batal</a>
                            <button type="submit" class="rounded-md cursor-pointer bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all hover:shadow-md">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>