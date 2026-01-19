<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Pembayaran Registrasi</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .box { border: 1px solid #ccc; padding: 20px; width: 50%; margin-bottom: 20px; }
        .info-table td { padding: 5px; }
        .input-group { margin-bottom: 15px; }
        input, select { padding: 8px; width: 100%; box-sizing: border-box; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .alert { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

    <h2>Input Transaksi Pembayaran</h2>
    <a href="{{ url('/cari-mahasiswa?q='.$mhs->no_reg) }}">&laquo; Kembali</a>
    <hr>

    <div class="box" style="background-color: #f9f9f9;">
        <h3>Data Calon Mahasiswa</h3>
        <table class="info-table">
            <tr>
                <td width="150"><b>No. Registrasi</b></td>
                <td>: {{ $mhs->no_reg }}</td>
            </tr>
            <tr>
                <td><b>Nama Lengkap</b></td>
                <td>: {{ $mhs->nama_mhs }}</td>
            </tr>
            <tr>
                <td><b>Program Studi</b></td>
                <td>: {{ $mhs->nama_prodi ?? $mhs->kode_prodi }}</td>
            </tr>
            <tr>
                <td><b>Status Saat Ini</b></td>
                <td>: 
                    @if($mhs->nim)
                        <span style="color:green; font-weight:bold;">Sudah Punya NIM ({{ $mhs->nim }})</span>
                    @else
                        <span style="color:orange; font-weight:bold;">Calon Mahasiswa (Belum punya NIM)</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="box">
        <form action="{{ url('/transaksi/proses') }}" method="POST">
            @csrf
            <input type="hidden" name="no_reg" value="{{ $mhs->no_reg }}">

            <div class="input-group">
                <label>Jenis Pembayaran:</label>
                <select name="jenis_biaya" readonly>
                    <option value="Registrasi">Biaya Registrasi Awal / Daftar Ulang</option>
                </select>
            </div>

            <div class="input-group">
                <label>Nominal Pembayaran (Rp):</label>
                <input type="number" name="nominal" placeholder="Contoh: 5000000" required min="100000">
                <br>
                <small class="alert">*Sesuai ketentuan, sistem akan otomatis menerbitkan NIM jika pembayaran >= Rp 5.000.000</small>
            </div>

            <div class="input-group">
                <label>Petugas Penerima:</label>
                <input type="text" value="{{ Session::get('username') }} ({{ Session::get('role') }})" disabled style="background-color: #e9ecef;">
            </div>

            <button type="submit" onclick="return confirm('Apakah data pembayaran sudah benar?');">
                Simpan Transaksi
            </button>
        </form>
    </div>

</body>
</html>