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
        
        <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl mb-6 overflow-hidden">
            <div class="px-4 py-6 sm:px-8 sm:py-8 bg-gradient-to-r from-blue-600 to-blue-800 text-white flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="h-24 w-24 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold border-4 border-white/30 shadow-inner">
                     {{ substr($mahasiswa->nama_mhs, 0, 1) }}
                </div>
                
                <div class="text-center sm:text-left flex-1">
                    <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $mahasiswa->nama_mhs }}</h1>
                    <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-3">
                        <span class="inline-flex items-center rounded-md bg-white/20 px-2 py-1 text-sm font-medium text-white ring-1 ring-inset ring-white/30">
                            No. Reg: {{ $mahasiswa->no_reg }}
                        </span>
                        
                        @php
                            // Logic Status di View (Disamakan dengan Controller)
                            $total_bayar = \Illuminate\Support\Facades\DB::table('transaksi')
                                ->where('no_reg', $mahasiswa->no_reg)->sum('total_bayar');
                            $is_lunas_total = $total_bayar >= 19500000;
                        @endphp

                        @if($mahasiswa->nim)
                            @if($is_lunas_total)
                                <span class="inline-flex items-center rounded-md bg-green-400/90 px-2 py-1 text-sm font-medium shadow-sm">
                                    Mahasiswa Aktif (Lunas)
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-blue-400/90 px-2 py-1 text-sm font-medium shadow-sm">
                                    Mahasiswa Aktif (Angsuran)
                                </span>
                            @endif
                        @else
                            <span class="inline-flex items-center rounded-md bg-yellow-400/90 px-2 py-1 text-sm font-medium shadow-sm">
                                Calon Mahasiswa
                            </span>
                        @endif
                    </div>
                </div>

                @if(!$is_lunas_total)
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ url('/transaksi/bayar/' . $mahasiswa->no_reg) }}" class="inline-flex items-center rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-blue-600 shadow-sm hover:bg-slate-100 transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
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
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4 bg-blue-50/50 -mx-6 px-6">
                                <dt class="text-sm font-medium text-slate-900">Status Pembayaran</dt>
                                <dd class="mt-1 text-sm leading-6 sm:col-span-2 sm:mt-0">
                                    @if($is_lunas_total)
                                        <span class="text-green-700 font-bold flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Lunas Total (Rp {{ number_format($total_bayar, 0, ',', '.') }})
                                        </span>
                                    @else
                                        <span class="text-blue-700 font-bold">Belum Lunas</span>
                                        <p class="text-xs text-slate-500">Terbayar: Rp {{ number_format($total_bayar, 0, ',', '.') }} / 19.500.000</p>
                                    @endif
                                </dd>
                            </div>

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
                                <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-mono">{{ $mahasiswa->nim ? $mahasiswa->username : '-' }}</dd>
                            </div>
                            <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-slate-500">Password</dt>
                                <dd class="mt-1 text-sm text-slate-500 sm:col-span-2 sm:mt-0 italic">
                                    @if($mahasiswa->nim)
                                        <span class="text-red-600 font-bold text-lg bg-yellow-100 px-2 rounded font-mono">{{ $mahasiswa->password }}</span>
                                        <p class="text-xs text-slate-400 mt-1">*Harap catat password ini.</p>
                                    @else
                                        <span class="text-slate-400 italic">- (Belum Aktif)</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl h-fit">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center">
                            <svg class="h-5 w-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Data Kontak
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="divide-y divide-slate-100">
                            <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500 mb-1">Email Kampus</dt>
                                <dd class="text-sm text-slate-900">{{ $mahasiswa->email_kampus ?? '-' }}</dd>
                            </div>
                            <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500 mb-1">No. HP (WA)</dt>
                                <dd class="text-sm text-slate-900">{{ $mahasiswa->telepon ?? '-' }}</dd>
                            </div>
                            <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500 mb-1">Alamat</dt>
                                <dd class="text-sm text-slate-900">{{ $mahasiswa->alamat ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center">
                            <svg class="h-5 w-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Riwayat Pembayaran
                        </h3>
                    </div>
                    <div class="px-4 py-4 sm:p-6">
                        @php
                            $riwayat = \App\Models\Transaksi::where('no_reg', $mahasiswa->no_reg)->orderBy('tgl_bayar', 'desc')->get();
                        @endphp
    
                        @if($riwayat->isEmpty())
                            <p class="text-sm text-slate-500 italic text-center py-4">Belum ada riwayat transaksi.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="px-3 py-3 text-left text-xs font-medium text-slate-500 uppercase">No. TRX</th>
                                            <th class="px-3 py-3 text-left text-xs font-medium text-slate-500 uppercase">Tanggal</th>
                                            <th class="px-3 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nominal</th>
                                            <th class="px-3 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-200">
                                        @foreach($riwayat as $trx)
                                        <tr>
                                            <td class="px-3 py-3 text-xs font-mono text-slate-900">{{ $trx->no_transaksi }}</td>
                                            <td class="px-3 py-3 text-xs text-slate-500">{{ date('d/m/y H:i', strtotime($trx->tgl_bayar)) }}</td>
                                            <td class="px-3 py-3 text-xs font-bold text-blue-600">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</td>
                                            <td class="px-3 py-3 text-right text-xs">
                                                <a href="{{ url('/transaksi/cetak/' . $trx->no_transaksi) }}" target="_blank" class="text-blue-600 hover:text-blue-900 border border-blue-200 bg-blue-50 px-2 py-1 rounded">Struk</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-x-4">
            <button type="button" onclick="history.back()" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Kembali</button>
            <a href="{{ url('/detail/' . $mahasiswa->no_reg . '/edit') }}" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Edit Data</a>
        </div>
    </main>
</body>
</html>