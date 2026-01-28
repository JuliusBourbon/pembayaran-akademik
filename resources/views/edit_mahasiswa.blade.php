<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">

    @include('navbar')

    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8 mt-16">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Edit Data Mahasiswa
                </h2>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl overflow-hidden">
            <form id="form-edit-mhs" action="{{ route('updatemhs.store', $mhs->no_reg) }}" method="POST">
                @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="space-y-12">
                        <div class="border-b border-slate-900/10 pb-10">
                            <h2 class="text-lg font-semibold leading-7 text-slate-900">Akun Pengguna</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">Informasi kredensial untuk login mahasiswa.</p>

                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="username" class="block text-sm font-medium leading-6 text-slate-900">Username</label>
                                    <div class="mt-2">
                                        <input type="text" name="username" id="username" value="{{ old('username', $mhs->username) }}" class="block w-full rounded-md border-0 py-2 px-3 bg-slate-200 text-slate-600 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 cursor-not-allowed focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" disabled>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-6 text-slate-900">Password Baru</label>
                                    <div class="mt-2">
                                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin mengubah" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <p class="mt-1 text-xs text-slate-500">Minimal 6 karakter.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-slate-900/10 pb-10">
                            <h2 class="text-lg font-semibold leading-7 text-slate-900">Informasi Pribadi</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">Data diri Mahasiswa.</p>

                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                
                                <div class="sm:col-span-4">
                                    <label for="nama_mhs" class="block text-sm font-medium leading-6 text-slate-900">Nama Lengkap</label>
                                    <div class="mt-2">
                                        <input type="text" name="nama_mhs" id="nama_mhs" value="{{ old('nama_mhs', $mhs->nama_mhs) }}" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="kode_prodi" class="block text-sm font-medium leading-6 text-slate-900">Program Studi</label>
                                    <div class="mt-2">
                                        <select id="kode_prodi" name="kode_prodi" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                            <option value="IF" {{ $mhs->kode_prodi == 'IF' ? 'selected' : '' }}>Teknik Informatika</option>
                                            <option value="SI" {{ $mhs->kode_prodi == 'SI' ? 'selected' : '' }}>Sistem Informasi</option>
                                            <option value="DKV" {{ $mhs->kode_prodi == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                                            <option value="MJ" {{ $mhs->kode_prodi == 'MJ' ? 'selected' : '' }}>Manajemen</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="alamat" class="block text-sm font-medium leading-6 text-slate-900">Alamat</label>
                                    <div class="mt-2">
                                        <textarea id="alamat" name="alamat" rows="3" class="block w-full rounded-md border-0 py-1.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('alamat', $mhs->alamat) }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div>
                            <h2 class="text-lg font-semibold leading-7 text-slate-900">Data Kontak</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">Nomor yang dapat dihubungi.</p>

                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="telepon" class="block text-sm font-medium leading-6 text-slate-900">No. Telepon / WA</label>
                                    <div class="mt-2">
                                        <input type="number" name="telepon" id="telepon" value="{{ old('telepon', $mhs->telepon) }}" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="tlp_ortu" class="block text-sm font-medium leading-6 text-slate-900">No. Telepon Orang Tua</label>
                                    <div class="mt-2">
                                        <input type="number" name="tlp_ortu" id="tlp_ortu" value="{{ old('tlp_ortu', $mhs->tlp_ortu) }}" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                @if($mhs->nim) <div class="sm:col-span-4">
                                    <label for="email_kampus" class="block text-sm font-medium leading-6 text-slate-900">Email Kampus</label>
                                    <div class="mt-2">
                                        <input type="email" name="email_kampus" id="email_kampus" value="{{ old('email_kampus', $mhs->email_kampus) }}" class="block w-full rounded-md border-0 py-2 px-3 bg-slate-200 cursor-not-allowed text-slate-600 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" disabled>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-slate-50 px-4 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-200 gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.toggle('hidden')" class="cursor-pointer rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                        Simpan Transaksi
                    </button>
                    <a href="{{ url('/detail/' . $mhs->no_reg) }}" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">
                        Batal
                    </a>
                </div>
            </form>
            @include('modal-konfirmasi', [
                'modalId' => 'modal-edit',
                'formId'  => 'form-edit-mhs',
                'judul'   => 'Simpan Perubahan?',
                'pesan'   => 'Pastikan data sudah sesuai'
            ])
        </div>

    </main>

</body>
</html>