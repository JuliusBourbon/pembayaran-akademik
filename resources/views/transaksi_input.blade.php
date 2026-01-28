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
                        <div class="mt-4 pt-4 border-t border-dashed border-slate-200">
                            <p class="text-sm font-medium text-slate-500">Status Pembayaran:</p>
                            @if($is_new_student)
                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Pembayaran Awal</span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">Pembayaran Lanjutan</span>
                                @if($plan_angsuran)
                                    <span class="block mt-1 text-xs text-slate-500">Paket Angsuran: {{ $plan_angsuran }}x</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <form id="form-transaksi-pembayaran" action="{{ url('/transaksi/proses') }}" method="POST" class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl" onsubmit="return confirm('Pastikan data pembayaran sudah benar. Lanjutkan?');">
                    @csrf
                    <input type="hidden" name="no_reg" value="{{ $mhs->no_reg }}">

                    <div class="px-4 py-5 sm:p-6 space-y-8">
                        
                        <div>
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-4">1. Komponen Dasar</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($biaya as $b)
                                    @if($b->id_jenis_biaya != 'KUL') 
                                        @php $is_lunas = $status_bayar[$b->id_jenis_biaya] ?? false; @endphp
                                        <div class="relative flex items-center p-4 border rounded-lg {{ $is_lunas ? 'bg-green-50 border-green-200' : 'hover:bg-slate-50 border-slate-200' }}">
                                            @if($is_lunas)
                                                <div class="flex h-6 items-center"><svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label class="font-bold text-green-800">{{ $b->nama_biaya }}</label>
                                                    <p class="text-green-600 text-xs font-semibold">SUDAH LUNAS</p>
                                                </div>
                                            @else
                                                <div class="flex h-6 items-center">
                                                    <input id="biaya_{{ $b->id_jenis_biaya }}" name="detail_bayar[]" value="{{ $b->nama_biaya }}|{{ $b->nominal }}" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600" onchange="hitungTotal()" {{ $is_new_student ? 'checked onclick="return false;"' : '' }}>
                                                </div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label for="biaya_{{ $b->id_jenis_biaya }}" class="font-medium text-slate-900">{{ $b->nama_biaya }} @if($is_new_student) <span class="text-red-500 text-xs font-bold">(Wajib)</span> @endif</label>
                                                    <p class="text-slate-500 font-mono">Rp {{ number_format($b->nominal, 0, ',', '.') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        <div>
                            <h4 class="text-sm font-bold text-blue-600 uppercase tracking-wide mb-4">2. Biaya Kuliah</h4>
                            
                            @if($status_bayar['KUL_FULL'])
                                <div class="p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                                    <svg class="h-6 w-6 text-green-600 mr-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span class="font-bold text-green-800">Biaya Kuliah Sudah LUNAS (Full Payment)</span>
                                </div>
                            @else
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="pilihan_metode_bayar">
                                        @if(!$plan_angsuran)
                                        <div class="relative flex items-start p-4 border rounded-lg hover:bg-slate-50 cursor-pointer" onclick="document.getElementById('radio_lunas').click()">
                                            <div class="min-w-0 flex-1 text-sm">
                                                <label for="radio_lunas" class="font-medium text-slate-900">Langsung Lunas</label>
                                                <p class="text-slate-500">Bayar Sekaligus <br><strong class="text-green-600">Rp 8.500.000</strong></p>
                                            </div>
                                            <div class="ml-3 flex h-6 items-center">
                                                <input id="radio_lunas" name="opsi_kuliah" type="radio" value="lunas" checked onclick="toggleMode(false)" class="h-4 w-4 border-slate-300 text-blue-600">
                                            </div>
                                        </div>
                                        @endif

                                        <div class="relative flex items-start p-4 border rounded-lg hover:bg-slate-50 cursor-pointer" onclick="document.getElementById('radio_angsur').click()">
                                            <div class="min-w-0 flex-1 text-sm">
                                                <label for="radio_angsur" class="font-medium text-slate-900">Diangsur (Cicilan)</label>
                                                <p class="text-slate-500">Total Akumulasi <br><strong class="text-slate-700">Rp 9.000.000</strong></p>
                                            </div>
                                            <div class="ml-3 flex h-6 items-center">
                                                <input id="radio_angsur" name="opsi_kuliah" type="radio" value="angsur" onclick="toggleMode(true)" class="h-4 w-4 border-slate-300 text-blue-600">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="container_biaya_kuliah" class="space-y-3"></div>

                                    <div id="area_opsi_angsuran" class="hidden mt-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                        <label class="block text-sm font-medium text-slate-900 mb-2">Skema Angsuran</label>
                                        
                                        <select id="select_jumlah_angsuran" onchange="generateInputAngsuran()" 
                                            class="block w-full max-w-xs rounded-md border-0 py-2 pl-3 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-blue-600 sm:text-sm sm:leading-6 disabled:bg-slate-100 disabled:text-slate-500"
                                            {{ $plan_angsuran ? 'disabled' : '' }}>
                                            <option value="2" {{ $plan_angsuran == 2 ? 'selected' : '' }}>2 Kali (Rp 4.500.000 / bayar)</option>
                                            <option value="3" {{ $plan_angsuran == 3 ? 'selected' : '' }}>3 Kali (Rp 3.000.000 / bayar)</option>
                                            <option value="4" {{ $plan_angsuran == 4 ? 'selected' : '' }}>4 Kali (Rp 2.250.000 / bayar)</option>
                                        </select>
                                        
                                        @if($plan_angsuran)
                                            <p class="text-xs text-amber-600 mt-2 font-semibold">*Skema angsuran terkunci karena pembayaran sudah berjalan.</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100 flex justify-between items-center">
                            <div>
                                <span class="text-sm font-medium text-slate-600 block">Total Pembayaran Hari Ini:</span>
                                <span class="text-xs text-slate-400">(Item yang dicentang)</span>
                            </div>
                            <span id="display_total" class="text-2xl font-bold text-blue-700 font-mono">Rp 0</span>
                        </div>
                    </div>

                    <div class="px-4 py-4 sm:px-6 bg-slate-50 rounded-b-xl flex justify-end gap-x-4 border-t border-slate-100">
                        <a href="{{ url('/cari-mahasiswa') }}" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">
                            Kembali
                        </a>
                        <button type="button" onclick="document.getElementById('modal-simpan').classList.toggle('hidden')" class="cursor-pointer rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
                @include('modal-konfirmasi', [
                    'modalId' => 'modal-simpan',
                    'formId'  => 'form-transaksi-pembayaran',
                    'judul'   => 'Simpan Pembayaran?',
                    'pesan'   => 'Pastikan nominal uang yang diterima sudah sesuai. Data tidak dapat diubah setelah disimpan.'
                ])
            </div>
        </div>
    </main>

    <script>
        const TOTAL_ANGSURAN = 9000000;
        const TOTAL_LUNAS = 8500000;
        const IS_NEW_STUDENT = @json($is_new_student);
        const EXISTING_PLAN = @json($plan_angsuran);
        const PAID_INSTALLMENTS = @json($paid_angsuran); 

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        function hitungTotal() {
            let total = 0;
            const checkboxes = document.querySelectorAll('input[name="detail_bayar[]"]:checked');
            checkboxes.forEach((cb) => {
                let parts = cb.value.split('|');
                total += parseInt(parts[1]);
            });
            document.getElementById('display_total').innerText = formatRupiah(total);
        }

        function toggleMode(isAngsur) {
            const areaOpsi = document.getElementById('area_opsi_angsuran');
            const container = document.getElementById('container_biaya_kuliah');
            container.innerHTML = ''; 

            if (isAngsur) {
                areaOpsi.classList.remove('hidden');
                generateInputAngsuran();
            } else {
                areaOpsi.classList.add('hidden');
                const div = document.createElement('div');
                div.className = "relative flex items-start p-4 border border-green-200 bg-green-50 rounded-lg";

                div.innerHTML = `
                    <div class="flex h-6 items-center">
                        <input name="detail_bayar[]" value="Biaya Kuliah (Lunas)|${TOTAL_LUNAS}" type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-blue-600" onchange="hitungTotal()">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label class="font-medium text-slate-900">Biaya Kuliah (Pelunasan Awal)</label>
                        <p class="text-slate-500 font-mono">${formatRupiah(TOTAL_LUNAS)}</p>
                    </div>
                `;
                container.appendChild(div);
            }
            hitungTotal();
        }

        function generateInputAngsuran() {
            const container = document.getElementById('container_biaya_kuliah');
            const jumlahKali = parseInt(document.getElementById('select_jumlah_angsuran').value);
            const nominalPerBayar = TOTAL_ANGSURAN / jumlahKali;

            container.innerHTML = '';

            for (let i = 1; i <= jumlahKali; i++) {
                const div = document.createElement('div');
                
              
                const isPaid = PAID_INSTALLMENTS.includes(i);
                
                if (isPaid) {
                  
                    div.className = "relative flex items-center p-3 border border-green-200 bg-green-50 rounded-lg";
                    div.innerHTML = `
                        <div class="flex h-6 items-center">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div class="ml-3 flex-1 text-sm leading-6 flex justify-between">
                            <label class="font-bold text-green-800">Angsuran ke-${i}</label>
                            <span class="font-mono text-green-700 font-semibold">LUNAS (${formatRupiah(nominalPerBayar)})</span>
                        </div>
                    `;
                } else {
                    div.className = "relative flex items-center p-3 border border-slate-200 rounded-lg";
                    
                    let isNext = false;
                    if (IS_NEW_STUDENT && i === 1) isNext = true;
                    if (!IS_NEW_STUDENT && i === (Math.max(0, ...PAID_INSTALLMENTS) + 1)) isNext = true;

                    let checkedAttr = isNext ? 'checked' : '';
                    let labelExtra = isNext ? '<span class="text-blue-600 text-xs font-bold ml-2">(Bayar Sekarang)</span>' : '';

                    div.innerHTML = `
                        <div class="flex h-6 items-center">
                            <input name="detail_bayar[]" value="Biaya Kuliah (Angsuran ${i})|${nominalPerBayar}" type="checkbox" ${checkedAttr} class="h-4 w-4 rounded border-slate-300 text-blue-600" onchange="hitungTotal()">
                        </div>
                        <div class="ml-3 flex-1 text-sm leading-6 flex justify-between">
                            <label class="font-medium text-slate-700">Angsuran ke-${i} ${labelExtra}</label>
                            <span class="font-mono font-bold text-slate-900">${formatRupiah(nominalPerBayar)}</span>
                        </div>
                    `;
                }
                container.appendChild(div);
            }
            hitungTotal();
        }

        if (EXISTING_PLAN) {
            document.getElementById('radio_angsur').checked = true;
            toggleMode(true);
            document.getElementById('pilihan_metode_bayar').classList.add('hidden');
        } else {
            toggleMode(false);
        }
        
        hitungTotal(); 
    </script>
</body>
</html>