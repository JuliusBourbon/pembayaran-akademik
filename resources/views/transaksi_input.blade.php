<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pembayaran Registrasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    @include('navbar')
    
    <main class="max-w-7xl mx-auto py-10 px-6 lg:px-8 mt-16">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Input Pembayaran Registrasi</h2>
            <p class="text-slate-500">Syarat NIM: Lunas Total <span class="font-bold text-slate-900">Rp 19.500.000</span> (Lunas Awal) atau <span class="font-bold text-slate-900">Rp 20.000.000</span> (Angsuran).</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl sticky top-24">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-100 bg-slate-50 rounded-t-xl">
                        <h3 class="text-lg font-semibold text-slate-900">Data Mahasiswa</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">No. Registrasi</p>
                            <p class="text-lg font-mono font-bold text-slate-900">{{ $mhs->no_reg }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Nama Lengkap</p>
                            <p class="text-base font-semibold text-slate-900">{{ $mhs->nama_mhs }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Program Studi</p>
                            <p class="text-base text-slate-700">{{ $mhs->nama_prodi ?? $mhs->kode_prodi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <form action="{{ url('/transaksi/proses') }}" method="POST" class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl" onsubmit="return confirm('Pastikan data pembayaran sudah benar. Lanjutkan?');">
                    @csrf
                    <input type="hidden" name="no_reg" value="{{ $mhs->no_reg }}">

                    <div class="px-4 py-5 sm:p-6 space-y-8">
                        
                        <div>
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-4">1. Komponen Dasar</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-900 mb-2">BPP (Biaya Pengembangan)</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"><span class="text-slate-500 sm:text-sm">Rp</span></div>
                                        <input type="number" name="bpp" id="input_bpp" value="8500000" class="block w-full rounded-md border-0 py-2 pl-10 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm font-mono" oninput="hitungTotal()">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Biaya Penunjang</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"><span class="text-slate-500 sm:text-sm">Rp</span></div>
                                        <input type="number" name="penunjang" id="input_penunjang" value="2500000" class="block w-full rounded-md border-0 py-2 pl-10 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm font-mono" oninput="hitungTotal()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        <div>
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-4">2. Biaya Kuliah</h4>
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="relative flex items-start p-4 border rounded-lg hover:bg-slate-50 cursor-pointer" onclick="document.getElementById('radio_lunas').click()">
                                        <div class="min-w-0 flex-1 text-sm">
                                            <label for="radio_lunas" class="font-medium text-slate-900">Langsung Lunas</label>
                                            <p class="text-slate-500">Bayar Sekaligus <br><strong class="text-green-600">Rp 8.500.000</strong></p>
                                        </div>
                                        <div class="ml-3 flex h-6 items-center">
                                            <input id="radio_lunas" name="opsi_kuliah" type="radio" value="lunas" checked onclick="toggleMode(false)" class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-600">
                                        </div>
                                    </div>

                                    <div class="relative flex items-start p-4 border rounded-lg hover:bg-slate-50 cursor-pointer" onclick="document.getElementById('radio_angsur').click()">
                                        <div class="min-w-0 flex-1 text-sm">
                                            <label for="radio_angsur" class="font-medium text-slate-900">Diangsur (Cicilan)</label>
                                            <p class="text-slate-500">Total Akumulasi <br><strong class="text-slate-700">Rp 9.000.000</strong></p>
                                        </div>
                                        <div class="ml-3 flex h-6 items-center">
                                            <input id="radio_angsur" name="opsi_kuliah" type="radio" value="angsur" onclick="toggleMode(true)" class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-600">
                                        </div>
                                    </div>
                                </div>

                                <div id="area_angsuran" class="hidden mt-6 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <label class="block text-sm font-medium text-slate-900 mb-2">Mau dibagi berapa kali angsuran?</label>
                                    <select id="select_jumlah_angsuran" onchange="generateInputAngsuran()" class="block w-full max-w-xs rounded-md border-0 py-2 pl-3 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-blue-600 sm:text-sm sm:leading-6">
                                        <option value="2">2 Kali (Rp 4.500.000 / bayar)</option>
                                        <option value="3">3 Kali (Rp 3.000.000 / bayar)</option>
                                        <option value="4">4 Kali (Rp 2.250.000 / bayar)</option>
                                    </select>
                                    
                                    <div class="mt-4">
                                        <p class="text-xs text-slate-500 mb-2 font-medium uppercase tracking-wide">Rincian Tagihan yang akan dibuat:</p>
                                        <div id="container_input_angsuran" class="space-y-3">
                                            </div>
                                    </div>
                                    <p class="text-xs text-red-500 mt-2 italic">*Hapus baris angsuran yang <b>TIDAK</b> dibayarkan hari ini.</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100 flex justify-between items-center">
                            <div>
                                <span class="text-sm font-medium text-slate-600 block">Total Pembayaran Hari Ini:</span>
                                <span class="text-xs text-slate-400">(BPP + Penunjang + Biaya Kuliah yg Dibayar)</span>
                            </div>
                            <span id="display_total" class="text-2xl font-bold text-blue-700 font-mono">Rp 0</span>
                        </div>

                    </div>

                    <div class="px-4 py-4 sm:px-6 bg-slate-50 rounded-b-xl flex justify-end gap-x-4 border-t border-slate-100">
                        <a href="{{ url('/cari-mahasiswa?q='.$mhs->no_reg) }}" class="text-sm font-semibold text-slate-900 leading-6 px-3 py-2">Batal</a>
                        <button type="submit" class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-all">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const TOTAL_ANGSURAN = 9000000;
        const TOTAL_LUNAS = 8500000;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        // Fungsi Hitung Total Realtime
        function hitungTotal() {
            let total = 0;
            
            // 1. Ambil BPP & Penunjang
            total += Number(document.getElementById('input_bpp').value) || 0;
            total += Number(document.getElementById('input_penunjang').value) || 0;

            // 2. Ambil Biaya Kuliah
            const isLunas = document.getElementById('radio_lunas').checked;
            if (isLunas) {
                total += TOTAL_LUNAS;
            } else {
                // Loop semua input angsuran yang ADA di form
                const inputs = document.querySelectorAll('.input-angsuran-item');
                inputs.forEach(input => {
                    total += Number(input.value) || 0;
                });
            }

            // Update Tampilan Total
            document.getElementById('display_total').innerText = formatRupiah(total);
        }

        // Toggle Tampilan Lunas vs Angsur
        function toggleMode(isAngsur) {
            const area = document.getElementById('area_angsuran');
            if (isAngsur) {
                area.classList.remove('hidden');
                generateInputAngsuran(); // Auto generate saat mode aktif
            } else {
                area.classList.add('hidden');
                // Hapus semua input angsuran agar tidak terhitung
                document.getElementById('container_input_angsuran').innerHTML = '';
            }
            hitungTotal();
        }

        // Logic Auto-Split Angsuran
        function generateInputAngsuran() {
            const container = document.getElementById('container_input_angsuran');
            const jumlahKali = parseInt(document.getElementById('select_jumlah_angsuran').value);
            
            // Hitung nominal per kali bayar
            const nominalPerBayar = TOTAL_ANGSURAN / jumlahKali;

            // Reset container
            container.innerHTML = '';

            for (let i = 1; i <= jumlahKali; i++) {
                const div = document.createElement('div');
                div.className = "flex items-center gap-2";
                div.id = `row_angsuran_${i}`;
                
                div.innerHTML = `
                    <span class="text-sm font-medium text-slate-500 w-24">Angsuran ${i}</span>
                    <div class="relative rounded-md shadow-sm w-full">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"><span class="text-slate-500 sm:text-xs">Rp</span></div>
                        <input type="number" name="angsuran[]" value="${nominalPerBayar}" class="input-angsuran-item block w-full rounded-md border-0 py-1.5 pl-8 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 font-mono" oninput="hitungTotal()" required>
                    </div>
                    <button type="button" onclick="hapusBaris(this)" class="text-red-500 hover:text-red-700" title="Hapus jika tidak dibayar sekarang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                `;
                container.appendChild(div);
            }
            hitungTotal();
        }

        function hapusBaris(btn) {
            btn.parentElement.remove();
            hitungTotal();
        }

        // Init Hitung Awal
        hitungTotal();
    </script>
</body>
</html>