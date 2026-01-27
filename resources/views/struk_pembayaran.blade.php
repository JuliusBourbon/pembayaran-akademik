<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $trx->no_transaksi }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; }
            .struk-area { 
                box-shadow: none !important; 
                border: none !important; 
                margin: 0 !important; 
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen font-mono text-slate-900" onload="window.print()">
    <div class="no-print fixed top-0 inset-x-0 bg-white border-b border-slate-200 p-4 shadow-sm z-50 flex justify-center gap-4">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-6 rounded shadow transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Struk
        </button>
        <button onclick="window.close()" class="bg-slate-200 hover:bg-slate-300 text-slate-800 text-sm font-bold py-2 px-6 rounded shadow transition">
            Tutup
        </button>
    </div>

    <div class="struk-area mx-auto mt-24 mb-10 bg-white p-6 shadow-lg border border-slate-200 sm:rounded-none">
        
        <div class="text-center pb-4 mb-4 flex flex-col items-center gap-2">
            <img src="https://unikom.ac.id/_next/image?url=%2Fimages%2Flogo-unikom.webp&w=3840&q=75" class="max-w-1/2 max-h-1/2">
            {{-- <h1 class="text-sm font-black uppercase">Universitas Komputer Indonesia</h1> --}}
            <p class="text-base text-slate-600 max-w-2/3">Jl. Dipati Ukur No.112-116, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132</p>
            <div class="mt-3">
                <span class="font-bold border border-slate-800 inline-block px-5 py-2 rounded-sm">BUKTI LUNAS</span>
            </div>
            <p class="text-base mt-2 font-mono">{{ $trx->no_transaksi }}</p>
        </div>

        <div class="grid grid-cols-3 gap-2 border-y border-dashed border-slate-800">
            <div class="text-xs space-y-1 p-3">
                <div class="w-full flex justify-center font-bold">
                    <h1>TERIMA DARI</h1>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Nama</span>
                    <span>: {{ $trx->nama_mhs }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">No. Reg</span>
                    <span>: {{ $trx->no_reg }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">NIM</span>
                    <span>: {{ $trx->nim }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Alamat</span>
                    <span>: {{ $trx->alamat }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Telepon / HP</span>
                    <span>: {{ $trx->telepon }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">HP Orang Tua</span>
                    <span>: {{ $trx->tlp_ortu }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Program Studi</span>
                    <span>: {{ $trx->nama_prodi }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">User</span>
                    <span>: {{ $trx->username }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Password</span>
                    <span>: {{ $trx->password }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Email</span>
                    <span class="break-all">: {{ $trx->email_kampus }}</span>
                </div>
                <div class="flex">
                    <span class="w-16 shrink-0 text-slate-500">Tanggal</span>
                    <span>: {{ date('d/m/y H:i', strtotime($trx->tgl_bayar)) }}</span>
                </div>
            </div>
            <div class="text-xs space-y-1 border-x border-dashed p-3">
                <div class="w-full flex justify-center font-bold">
                    <h1>BIAYA</h1>
                </div>
                <div class="flex h-full flex-col p-3">
                    <div class="h-[90%]">
                        <div>
                            <span class="text-base">
                                @foreach($trx->details as $item)
                                    <p class="py-5">
                                        {{ $item->jenis_biaya }} <br>
                                    </p>
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-xs space-y-1 p-3">
                <div class="w-full flex justify-center font-bold">
                    <h1>JUMLAH</h1>
                </div>
                <div class="flex h-full flex-col p-3">
                    <div class="h-[90%]">
                        <div>
                            <div class="text-base flex flex-col gap-2">
                                @foreach($trx->details as $item)
                                    <p class="py-5">
                                        {{ number_format($item->nominal, 0, ',', '.') }} <br>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class=" border-t">
                        <div class="text-base flex flex-col gap-2">
                            Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-8 mb-4 text-[10px] uppercase">
            <div class="text-center w-[45%]">
                <p class="text-slate-500 mb-8">{{ $trx->nama_mhs }}</p>
                <div class="border-b border-slate-800 border-dotted pb-1 py-20">
                    <span class="font-bold text-slate-900 block truncate">
                        {{-- {{ $trx->nama_mhs }} --}}
                    </span>
                </div>
            </div>

            <div class="text-center w-[45%]">
                <p class="text-slate-500 mb-8">{{ $trx->nama_petugas }}</p>
                <div class="border-b border-slate-800 border-dotted pb-1 py-20">
                    <span class="font-bold text-slate-900 block truncate">
                    </span>
                </div>
            </div>
        </div>

        <div class="text-center text-[10px] space-y-1 text-slate-600">
            <p class="italic mt-2">"Simpan resi ini sebagai bukti pembayaran yang sah"</p>
            <p class="mt-4 text-[8px] text-slate-400">Dicetak: {{ date('d-m-Y H:i:s') }}</p>
        </div>

    </div>

</body>
</html>