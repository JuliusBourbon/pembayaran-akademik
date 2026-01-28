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

        <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-slate-200">
    
            <div class="px-4 py-5 sm:px-6 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-bold text-slate-900">Profil Mahasiswa</h3>
                    <p class="mt-1 text-sm text-slate-500">Detail informasi akademik dan data pribadi.</p>
                </div>
                
                <div>
                    @if($is_lunas)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            Aktif / Lunas
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.88 2.12z" clip-rule="evenodd"></path></svg>
                            Belum Lunas
                        </span>
                    @endif
                </div>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">

                    <div class="sm:col-span-1" id="container-nama_mhs">
                        <dt class="text-sm font-medium text-slate-500">Nama Lengkap</dt>
                        
                        <div id="view-nama_mhs" class="mt-1 flex items-center justify-between group">
                            <span class="text-sm text-slate-900">{{ $mahasiswa->nama_mhs }}</span>
                            <button type="button" onclick="toggleEdit('nama_mhs')" class="text-blue-600 hover:text-blue-800 text-xs font-medium transition-opacity flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah
                            </button>
                        </div>

                        <form id="form-nama_mhs" action="{{ url('/mahasiswa/dashboard/' . $mahasiswa->no_reg) }}" method="POST" class="hidden mt-1">
                            @csrf
                            <input type="hidden" name="field" value="nama_mhs">
                            
                            <div class="flex gap-2">
                                <input type="text" name="nama_mhs" value="{{ $mahasiswa->nama_mhs }}" class="block w-full rounded-md border-slate-300 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-blue-600 sm:text-sm">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-blue-500">Simpan</button>
                                <button type="button" onclick="toggleEdit('nama_mhs')" class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded text-xs font-bold hover:bg-slate-300">Batal</button>
                            </div>
                        </form>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Nomor Registrasi</dt>
                        <dd class="mt-1 text-sm font-mono text-slate-900">{{ $mahasiswa->no_reg }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">NIM (Nomor Induk Mahasiswa)</dt>
                        <dd class="mt-1 text-sm font-mono font-bold text-blue-600">
                            {{ $mahasiswa->nim ?? '-' }}
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Program Studi</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $mahasiswa->kode_prodi }}</dd>
                    </div>

                    <div class="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Kontak & Alamat (Dapat Diubah)</h4>
                    </div>

                    <div class="sm:col-span-1" id="container-telepon">
                        <dt class="text-sm font-medium text-slate-500">No. Telepon / WhatsApp</dt>
                        
                        <div id="view-telepon" class="mt-1 flex items-center justify-between group">
                            <span class="text-sm text-slate-900">{{ $mahasiswa->telepon }}</span>
                            <button type="button" onclick="toggleEdit('telepon')" class="text-blue-600 hover:text-blue-800 text-xs font-medium transition-opacity flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah
                            </button>
                        </div>

                        <form id="form-telepon" action="{{ url('/mahasiswa/dashboard/' . $mahasiswa->no_reg) }}" method="POST" class="hidden mt-1">
                            @csrf
                            <input type="hidden" name="field" value="telepon"> <div class="flex gap-2">
                                <input type="number" name="telepon" value="{{ $mahasiswa->telepon }}" class="block w-full rounded-md border-slate-300 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-blue-500">Simpan</button>
                                <button type="button" onclick="toggleEdit('telepon')" class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded text-xs font-bold hover:bg-slate-300">Batal</button>
                            </div>
                        </form>
                    </div>

                    <div class="sm:col-span-1" id="container-tlp_ortu">
                        <dt class="text-sm font-medium text-slate-500">No. Telepon Orang Tua</dt>
                        
                        <div id="view-tlp_ortu" class="mt-1 flex items-center justify-between group">
                            <span class="text-sm text-slate-900">{{ $mahasiswa->tlp_ortu }}</span>
                            <button type="button" onclick="toggleEdit('tlp_ortu')" class="text-blue-600 hover:text-blue-800 text-xs font-medium transition-opacity flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah
                            </button>
                        </div>

                        <form id="form-tlp_ortu" action="{{ url('/mahasiswa/dashboard/' . $mahasiswa->no_reg) }}" method="POST" class="hidden mt-1">
                            @csrf
                            <input type="hidden" name="field" value="tlp_ortu">
                            
                            <div class="flex gap-2">
                                <input type="number" name="tlp_ortu" value="{{ $mahasiswa->tlp_ortu }}" class="block w-full rounded-md border-slate-300 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-blue-600 sm:text-sm">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-blue-500">Simpan</button>
                                <button type="button" onclick="toggleEdit('tlp_ortu')" class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded text-xs font-bold hover:bg-slate-300">Batal</button>
                            </div>
                        </form>
                    </div>

                    <div class="sm:col-span-2" id="container-alamat">
                        <dt class="text-sm font-medium text-slate-500">Alamat Domisili</dt>
                        
                        <div id="view-alamat" class="mt-1 flex justify-between group bg-slate-50 p-3 rounded-md border border-slate-100">
                            <span class="text-sm text-slate-900">{{ $mahasiswa->alamat }}</span>
                            <button type="button" onclick="toggleEdit('alamat')" class="text-blue-600 hover:text-blue-800 text-xs font-medium transition-opacity flex items-start ml-2">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah
                            </button>
                        </div>

                        <form id="form-alamat" action="{{ url('/mahasiswa/dashboard/' . $mahasiswa->no_reg) }}" method="POST" class="hidden mt-1">
                            @csrf
                            <input type="hidden" name="field" value="alamat">
                            
                            <div class="flex flex-col gap-2">
                                <textarea name="alamat" rows="3" class="block w-full rounded-md border-slate-300 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-blue-600 sm:text-sm">{{ $mahasiswa->alamat }}</textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="toggleEdit('alamat')" class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded text-xs font-bold hover:bg-slate-300">Batal</button>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-blue-500">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="sm:col-span-2 border-t border-slate-100 pt-4 mt-2">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Data Akun & Pembayaran</h4>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Email Kampus</dt>
                        <dd class="mt-1 text-sm font-mono text-slate-900">{{ $mahasiswa->email_kampus ?? 'Belum Aktif' }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Virtual Account (Pembayaran)</dt>
                        <dd class="mt-1 text-lg font-mono font-black text-slate-800 tracking-wide">
                            {{ $mahasiswa->virtual_account }}
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Username Login</dt>
                        <dd class="mt-1 text-sm text-slate-900">{{ $mahasiswa->username }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-slate-500">Password</dt>
                        <dd class="mt-1 text-sm font-mono text-slate-900 bg-yellow-50 px-2 py-1 inline-block rounded border border-yellow-100">
                            {{ $mahasiswa->password }}
                        </dd>
                    </div>

                </dl>
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
<script>
    function toggleEdit(fieldId) {
        const viewEl = document.getElementById('view-' + fieldId);
        const formEl = document.getElementById('form-' + fieldId);

        if (formEl.classList.contains('hidden')) {
            viewEl.classList.add('hidden');
            formEl.classList.remove('hidden');
        } else {
            viewEl.classList.remove('hidden');
            formEl.classList.add('hidden');
        }
    }
</script>
</html>