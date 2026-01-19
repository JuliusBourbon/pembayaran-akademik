<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Mahasiswa</title>
</head>
<body>

    <div style="padding: 10px; background-color: #f0f0f0; margin-bottom: 20px;">
        <b>Halo, {{ Session::get('username') }} ({{ Session::get('role') }})</b> |
        <a href="{{ url('/dashboard') }}">Kembali ke Dashboard</a> |
        <a href="{{ url('/logout') }}">Logout</a>
    </div>

    <h1>Cari Data Mahasiswa</h1>

    <form action="{{ url('/cari-mahasiswa') }}" method="GET">
        <label for="q">Cari berdasarkan No. Reg / Nama / NIM:</label><br>
        <input type="text" name="q" value="{{ $keyword }}" placeholder="Masukkan kata kunci..." required>
        <button type="submit">Cari</button>
        @if($keyword)
            <a href="{{ url('/cari-mahasiswa') }}"><button type="button">Reset</button></a>
        @endif
    </form>

    <hr>

    @if($keyword)
        <h3>Hasil Pencarian untuk: "{{ $keyword }}"</h3>
        
        @if(count($mahasiswa) > 0)
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color: #ddd;">
                        <th>No. Registrasi</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Status</th>
                        <th>Prodi</th> <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $mhs->no_reg }}</td>
                        <td>
                            {{ $mhs->nim ? $mhs->nim : '-' }}
                        </td>
                        <td>{{ $mhs->nama_mhs }}</td>
                        <td>
                            @if($mhs->nim != null)
                                <span style="color:green; font-weight:bold;">Mahasiswa Aktif</span>
                            @else
                                <span style="color:red; font-weight:bold;">Belum Registrasi</span>
                            @endif
                        </td>
                        <td>{{ $mhs->kode_prodi ?? '-' }}</td>
                        <td>
                            <a href="#">Detail</a>
                            
                            @if($mhs->nim == null)
                                | <a href="{{ url('/transaksi/bayar/' . $mhs->no_reg) }}">Bayar</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: red;">Data tidak ditemukan.</p>
        @endif

    @else
        <p>Silakan masukkan kata kunci untuk mulai mencari.</p>
    @endif

</body>
</html>