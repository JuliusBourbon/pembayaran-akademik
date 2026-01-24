<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('navbar')
    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8 mt-16">
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">Detail Mahasiswa</h2>
            </div>
        </div>
        <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl mb-6 overflow-hidden">
            <div class="px-4 py-6 sm:px-8 sm:py-8 bg-linear-to-r from-blue-600 to-blue-800 text-white flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="h-24 w-24 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold border-4 border-white/30 shadow-inner">
                    {{ substr($mahasiswa->nama_mhs, 0, 1) }}
                </div>
                
                <div class="text-center sm:text-left flex-1">
                    <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $mahasiswa->nama_mhs }}</h1>
                    <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-3">
                        <span class="inline-flex items-center rounded-md bg-white/20 px-2 py-1 text-sm font-medium text-white ring-1 ring-inset ring-white/30">
                            No. Reg: {{ $mahasiswa->no_reg }}
                        </span>
                        
                        @if($mahasiswa->nim)
                            <span class="inline-flex items-center rounded-md bg-green-400/90 px-2 py-1 text-sm font-medium shadow-sm">
                                Mahasiswa Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-yellow-400/90 px-2 py-1 text-sm font-medium shadow-sm">
                                Calon Mahasiswa
                            </span>
                        @endif
                    </div>
                </div>

                @if(!$mahasiswa->nim)
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ url('/transaksi/bayar/' . $mahasiswa->no_reg) }}" class="inline-flex items-center rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-blue-600 shadow-sm hover:bg-slate-100 transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM6.75 9.25a.75.75 0 000 1.5h4.59l-2.1 1.95a.75.75 0 001.02 1.1l3.5-3.25a.75.75 0 000-1.1l-3.5-3.25a.75.75 0 10-1.02 1.1l2.1 1.95H6.75z" clip-rule="evenodd" />
                            </svg>
                            Input Pembayaran
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center">
                            <svg class="h-5 w-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Informasi Akademik
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="divide-y divide-slate-100">
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">NIM</dt>
                                <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-mono">{{ $mahasiswa->nim ?? '-' }}</dd>
                            </div>
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">Program Studi</dt>
                                <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">{{ $mahasiswa->kode_prodi }}</dd>
                            </div>
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">Virtual Account</dt>
                                <dd class="mt-1 text-sm text-blue-600 font-bold sm:col-span-2 sm:mt-0 font-mono">{{ $mahasiswa->virtual_account ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center">
                            <svg class="h-5 w-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            Akun Mahasiswa
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="divide-y divide-slate-100">
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">Username</dt>
                                <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">{{ $mahasiswa->username ?? '-' }}</dd>
                            </div>
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">Password</dt>
                                <dd class="mt-1 text-sm text-slate-500 sm:col-span-2 sm:mt-0 italic"></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl h-fit">
                <div class="px-4 py-5 sm:px-6 border-b border-slate-100">
                    <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center">
                        <svg class="h-5 w-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Data Kontak
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dl class="divide-y divide-slate-100">
                        <div class="py-4">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Email Kampus</dt>
                            <dd class="text-sm text-slate-900 flex items-center">
                                <svg class="h-4 w-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                {{ $mahasiswa->email_kampus ?? '-' }}
                            </dd>
                        </div>

                        <div class="py-4">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Nomor Telepon (WA)</dt>
                            <dd class="text-sm text-slate-900 flex items-center">
                                <svg class="h-4 w-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $mahasiswa->telepon ?? '-' }}
                            </dd>
                        </div>

                        <div class="py-4">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Nomor Telepon Orang Tua</dt>
                            <dd class="text-sm text-slate-900 flex items-center">
                                <svg class="h-4 w-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ $mahasiswa->tlp_ortu ?? '-' }}
                            </dd>
                        </div>

                        <div class="py-4">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Alamat Domisili</dt>
                            <dd class="text-sm text-slate-900 flex items-start">
                                <svg class="h-4 w-4 text-slate-400 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $mahasiswa->alamat ?? '-' }}
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>

        </div>

        <div class="mt-8 flex items-center justify-end gap-x-4">
            <button type="button" onclick="history.back()" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">
                Kembali
            </button>
            <a href="#" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Edit Data Mahasiswa
            </a>
        </div>

    </main>

</body>
</html>