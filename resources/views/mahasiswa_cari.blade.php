<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa - Sistem Akademik</title>
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
                        <div class="relative flex-grow">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="q" id="q" value="{{ $keyword }}" class="block w-full rounded-none rounded-l-md border-0 py-2.5 pl-10 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Masukkan No. Reg, NIM, atau Nama..." required>
                        </div>
                        <button type="submit" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Cari Data</button>
                    </div>
                    
                    @if($keyword)
                        <div class="mt-2">
                            <a href="{{ url('/cari-mahasiswa') }}" class="text-sm text-red-600 hover:text-red-800 hover:underline">&times; Reset Pencarian</a>
                        </div>
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
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">No. Registrasi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">NIM</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Nama Mahasiswa</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Prodi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($mahasiswa as $mhs)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                        {{ $mhs->no_reg }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 font-mono">
                                        {{ $mhs->nim ? $mhs->nim : '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-900 font-semibold">
                                        {{ $mhs->nama_mhs }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                        {{ $mhs->kode_prodi ?? 'Umum' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($mhs->nim != null)
                                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Mahasiswa Aktif</span>
                                        @else
                                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Belum Registrasi</span>
                                        @endif
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex gap-3 items-center">
                                            <a href="#" class="text-slate-600 hover:text-blue-600">Detail</a>
                                            
                                            @if($mhs->nim == null)
                                                <a class="flex gap-2 cursor-pointer items-center text-blue-600 hover:text-blue-900 border border-blue-200 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition" href="{{ url('/transaksi/bayar/' . $mhs->no_reg) }}">
                                                    Bayar 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                                    </svg>
                                                </a>
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
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-slate-900">Hasil tidak ditemukan</h3>
                        <p class="mt-1 text-sm text-slate-500">Tidak terdapat data dengan pencarian tersebut</p>
                    </div>
                @endif
            </div>
        
        @else
            <div class="text-center py-20 bg-white rounded-xl border border-dashed border-slate-300">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">Pencarian</h3>
                <p class="mt-1 text-sm text-slate-500">Masukkan Nomor Registrasi, NIM atau Nama</p>
            </div>
        @endif

    </main>

</body>
</html>