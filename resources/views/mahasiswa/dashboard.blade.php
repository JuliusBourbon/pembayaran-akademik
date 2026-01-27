<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-slate-800">Portal Mahasiswa</h1>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-sm text-slate-600">Halo, {{ Session::get('mhs_nama') }}</span>
                    <a href="{{ url('/mahasiswa/logout') }}" class="text-red-600 text-sm hover:underline">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        
        @php
            $no_reg = Session::get('mhs_no_reg');
            $mahasiswa = \App\Models\Mahasiswa::where('no_reg', $no_reg)->first();
            $riwayat = \App\Models\Transaksi::where('no_reg', $no_reg)->orderBy('tgl_bayar', 'desc')->get();
            $total_bayar = \Illuminate\Support\Facades\DB::table('transaksi')->where('no_reg', $no_reg)->sum('total_bayar');
            $is_lunas = $total_bayar >= 19500000;
        @endphp

        <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                <h3 class="text-lg leading-6 font-medium text-slate-900">Status Akademik Anda</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-slate-500">Nama</p>
                        <p class="font-semibold">{{ $mahasiswa->nama_mhs }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Status</p>
                        @if($is_lunas)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Lunas / Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Belum Lunas
                            </span>
                        @endif
                    </div>
                    @if($mahasiswa->nim)
                    <div>
                        <p class="text-sm text-slate-500">NIM</p>
                        <p class="font-mono font-bold">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Email Kampus</p>
                        <p class="font-mono">{{ $mahasiswa->email_kampus }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                <h3 class="text-lg leading-6 font-medium text-slate-900">Riwayat Pembayaran</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                @if($riwayat->isEmpty())
                    <p class="text-slate-500 text-center">Belum ada data pembayaran.</p>
                @else
                    <ul class="divide-y divide-slate-200">
                        @foreach($riwayat as $trx)
                        <li class="py-4 flex justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-900">{{ $trx->no_transaksi }}</p>
                                <p class="text-sm text-slate-500">{{ $trx->tgl_bayar }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-slate-900">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</p>
                                <a href="{{ url('/transaksi/cetak/'.$trx->no_transaksi) }}" target="_blank" class="text-xs text-blue-600 hover:underline">Cetak Struk</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </main>
</body>
</html>