<div id="registrationModal" class="relative z-100 hidden">
    <div class="fixed inset-0 bg-slate-900/40 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                <div class="bg-slate-50 px-4 py-5 sm:px-6 border-b border-slate-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold leading-6 text-slate-900" id="modal-title">Formulir Pendaftaran Mahasiswa</h3>
                        <p class="mt-1 text-sm text-slate-500">Lengkapi data diri.</p>
                    </div>
                    <button type="button" onclick="closeModal()" class="cursor-pointer text-slate-400 hover:text-slate-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('mhs.store') }}" method="POST">
                    @csrf
                    <div class="px-4 py-5 sm:p-6 max-h-[70vh] overflow-y-auto">
                        
                        <div class="mb-6">
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-3">1. Buat Akun</h4>
                            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-slate-900">Username</label>
                                    <input type="text" name="username" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                                    <input type="password" name="password" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100 mb-6">

                        <div class="mb-6">
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-3">2. Data Pribadi</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-slate-900">Nama Lengkap</label>
                                    <input type="text" name="nama_mhs" placeholder="Sesuai Ijazah" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>

                                <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium leading-6 text-slate-900">No. Telepon (WhatsApp)</label>
                                        <input type="number" name="telepon" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium leading-6 text-slate-900">No. Telepon Orang Tua</label>
                                        <input type="number" name="tlp_ortu" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium leading-6 text-slate-900">Alamat Lengkap</label>
                                    <textarea name="alamat" rows="3" required class="mt-1 block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100 mb-6">

                        <div>
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-3">3. Pilihan Studi</h4>
                            <div>
                                <label class="block text-sm font-medium leading-6 text-slate-900">Program Studi Pilihan</label>
                                <select name="kode_prodi" required class="mt-1 block w-full rounded-md border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <option value="" disabled selected>Program Studi</option>
                                    @foreach ($prodi as $pd)
                                        <option value="{{ $pd->kode_prodi }}">{{ $pd->kode_prodi }} - {{ $pd->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 px-4 py-4 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-200">
                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto transition-all">
                            Kirim Pendaftaran
                        </button>
                        <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>