<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('navbar')
    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8 mt-16">
        
        <div class="md:flex md:items-center md:justify-between mb-6 px-4 sm:px-0">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">Data Mahasiswa</h2>
                <p class="mt-1 text-sm text-slate-500">Cari data calon mahasiswa</p>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl md:col-span-2 mb-8">
            <div class="px-4 py-6 sm:p-8">
                <form action="{{ url('/cari-mahasiswa') }}" method="GET" class="max-w-2xl">
                    <label for="q" class="block text-sm font-medium leading-6 text-slate-900">Cari Mahasiswa</label>
                    <div class="mt-2 flex rounded-md shadow-sm">
                        <div class="relative grow">
                            <input type="text" name="q" id="q" value="{{ $keyword }}" class="block w-full rounded-l-md border-0 py-2.5 pl-4 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Masukkan No. Reg, NIM, atau Nama..." required>
                        </div>
                        <button type="submit" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Cari Data</button>
                    </div>
                    @if($keyword)
                        <div class="mt-2"><a href="{{ url('/cari-mahasiswa') }}" class="text-sm text-red-600 hover:underline">&times; Reset Pencarian</a></div>
                    @endif
                </form>
            </div>
        </div>

        @if($keyword)
            <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl overflow-hidden">
                <div class="border-b border-slate-200 bg-slate-50 px-4 py-4 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-slate-900">Hasil Pencarian: <span class="text-blue-600">"{{ $keyword }}"</span></h3>
                </div>

                @if(count($mahasiswa) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-300">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">No. Reg / NIM</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Nama</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Prodi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($mahasiswa as $mhs)
                                    @php
                                        // Cek Status Pembayaran (Simple Query di View)
                                        $total = \Illuminate\Support\Facades\DB::table('transaksi')->where('no_reg', $mhs->no_reg)->sum('total_bayar');
                                        $is_lunas = $total >= 19500000;
                                    @endphp
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="font-medium text-slate-900">{{ $mhs->no_reg }}</div>
                                        <div class="text-slate-500 font-mono text-xs">{{ $mhs->nim ?? '-' }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-900 font-semibold">{{ $mhs->nama_mhs }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">{{ $mhs->kode_prodi ?? 'Umum' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($mhs->nim != null)
                                            @if($is_lunas)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Lunas</span>
                                            @else
                                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">Angsuran</span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Belum Aktif</span>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex gap-2 justify-end items-center">
                                            <a href="{{ url('/detail/' . $mhs->no_reg) }}" class="text-slate-600 hover:text-blue-600">Detail</a>
                                            @if(!$is_lunas)
                                                <a href="{{ url('/transaksi/bayar/' . $mhs->no_reg) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 px-2 py-1 rounded border border-blue-200">Bayar</a>
                                            @endif
                                            
                                            @if($total == 0)
                                                <form id="form-hapus-mahasiswa" action="{{ route('deletemhs', $mhs->no_reg) }}" method="POST" onsubmit="return confirm('Hapus {{ $mhs->nama_mhs }}?');" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="text-red-500 hover:text-red-700 ml-2" onclick="document.getElementById('modal-hapus').classList.toggle('hidden')">Hapus</button>
                                                </form>
                                                @include('modal-konfirmasi', [
                                                    'modalId' => 'modal-hapus',
                                                    'formId'  => 'form-hapus-mahasiswa',
                                                    'judul'   => 'Hapus data mahasiswa?',
                                                    'pesan'   => 'Data yang dihapus tidak dapat dikemabalikan!'
                                                ])
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-sm text-slate-500">Tidak terdapat data dengan pencarian tersebut</p>
                    </div>
                @endif
            </div>
        @endif
    </main>
</body>
</html>