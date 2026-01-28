<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen font-sans text-slate-900">
    @include('navbar')
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 mt-16">  
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Dashboard Overview
            </h2>
            <p class="mt-1 text-sm text-slate-500">Ringkasan aktivitas pembayaran dan data akademik.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            
            <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Total Mahasiswa</dt>
                                <dd class="text-2xl font-semibold text-slate-900">{{ $totalMhs }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Total Pendapatan</dt>
                                <dd class="text-xl font-semibold text-slate-900">Rp {{ number_format($totalUang / 1000000, 1, ',', '.') }} Jt</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Mahasiswa Lunas</dt>
                                <dd class="text-2xl font-semibold text-slate-900">{{ $mhsLunas }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="shrink-0 bg-orange-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-slate-500 truncate">Transaksi Hari Ini</dt>
                                <dd class="text-2xl font-semibold text-slate-900">{{ $trxHariIni }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg border border-slate-200 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-slate-900">Transaksi Terbaru</h3>
                        <a href="/laporan" class="text-sm text-blue-600 hover:text-blue-500 font-medium">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Mahasiswa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Nominal</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Petugas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @forelse($transaksiTerbaru as $trx)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">{{ $trx->nama_mhs }}</div>
                                        <div class="text-xs text-slate-500">{{ $trx->kode_prodi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-500">{{ date('d M Y', strtotime($trx->tgl_bayar)) }}</div>
                                        <div class="text-xs text-slate-400">{{ date('H:i', strtotime($trx->tgl_bayar)) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-slate-500">
                                        {{ $trx->nama_petugas ?? 'System' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-slate-500">Belum ada transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg border border-slate-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200 bg-slate-50">
                        <h3 class="text-lg leading-6 font-medium text-slate-900">Mahasiswa per Prodi</h3>
                    </div>
                    <ul class="divide-y divide-slate-200">
                        @foreach($statProdi as $p)
                        <li class="px-4 py-4 sm:px-6 hover:bg-slate-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                        {{ substr($p->kode_prodi, 0, 2) }}
                                    </span>
                                    <p class="ml-3 text-sm font-medium text-slate-900">{{ $p->nama_prodi }}</p>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-slate-100 text-slate-800">
                                        {{ $p->total }} Mahasiswa
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 w-full bg-slate-200 rounded-full h-1.5">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ ($p->total / $totalMhs) * 100 }}%"></div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </main>
</body>
</html>