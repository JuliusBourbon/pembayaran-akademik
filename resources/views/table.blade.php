<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Table</title>
</head>
<body>
    <div class="h-full w-full">
        <div class="h-full flex flex-col gap-2 justify-center items-center">
            <div>
                <div class="flex justify-between">
                    <h1>Program Studi</h1>
                    <a href="{{ route('prodi.createview') }}">Tambah</a>
                </div>
                <table>
                    <thead>
                        <th class="p-2 border">id_prodi</th>
                        <th class="p-2 border">nama_prodi</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($dataprodi as $dp)
                            <tr>
                                <td class="p-2 border">{{ $dp->id_prodi }}</td>
                                <td class="p-2 border">{{ $dp->nama_prodi }}</td>
                                <td class="p-2 border">{{ $dp->created_at }}</td>
                                <td class="p-2 border">{{ $dp->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('prodi.delete', $dp->id_prodi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('prodi.updateview', $dp->id_prodi) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1>Fakultas</h1>
                    <a href="{{ route('fakul.createview') }}">Tambah</a>
                </div>
                <table>
                    <thead>
                        <th class="p-2 border">id_fakultas</th>
                        <th class="p-2 border">nama_fakultas</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($datafakultas as $fk)
                        <tr>
                            <td class="p-2 border">{{ $fk->id_fakultas }}</td>
                            <td class="p-2 border">{{ $fk->nama_fakultas }}</td>
                            <td class="p-2 border">{{ $fk->created_at }}</td>
                            <td class="p-2 border">{{ $fk->updated_at }}</td>
                            <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('fakul.delete', $fk->id_fakultas) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('fakul.updateview', $fk->id_fakultas) }}">Ubah</a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1>Mahasiswa</h1>
                    <a href="{{ route('mhs.createview') }}">Tambah</a>
                </div>
                <table>
                    <thead>
                        <th class="p-2 border">nim</th>
                        <th class="p-2 border">nama</th>
                        <th class="p-2 border">alamat</th>
                        <th class="p-2 border">telepon</th>
                        <th class="p-2 border">telepon_ortu</th>
                        <th class="p-2 border">user</th>
                        <th class="p-2 border">password</th>
                        <th class="p-2 border">email</th>
                        <th class="p-2 border">virtual_account</th>
                        <th class="p-2 border">id_prodi</th>
                        <th class="p-2 border">id_fakultas</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($datamahasiswa as $mhs)
                            <tr>
                                <td class="p-2 border">{{ $mhs->nim }}</td>
                                <td class="p-2 border">{{ $mhs->nama }}</td>
                                <td class="p-2 border">{{ $mhs->alamat }}</td>
                                <td class="p-2 border">{{ $mhs->telepon }}</td>
                                <td class="p-2 border">{{ $mhs->telepon_ortu }}</td>
                                <td class="p-2 border">{{ $mhs->user }}</td>
                                <td class="p-2 border">{{ $mhs->password }}</td>
                                <td class="p-2 border">{{ $mhs->email }}</td>
                                <td class="p-2 border">{{ $mhs->virtual_account }}</td>
                                <td class="p-2 border">{{ $mhs->id_prodi }}</td>
                                <td class="p-2 border">{{ $mhs->id_fakultas }}</td>
                                <td class="p-2 border">{{ $mhs->created_at }}</td>
                                <td class="p-2 border">{{ $mhs->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('mhs.delete', $mhs->nim) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('mhs.updateview', $mhs->nim) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1>Bendahara</h1>
                    <a href="{{ route('bdh.createview') }}">Tambah</a>
                </div>
                <table>
                    <thead>
                        <th class="p-2 border">nip</th>
                        <th class="p-2 border">nama</th>
                        <th class="p-2 border">alamat</th>
                        <th class="p-2 border">telepon</th>
                        <th class="p-2 border">email</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($databendahara as $bd)
                            <tr>
                                <td class="p-2 border">{{ $bd->nip }}</td>
                                <td class="p-2 border">{{ $bd->nama }}</td>
                                <td class="p-2 border">{{ $bd->alamat }}</td>
                                <td class="p-2 border">{{ $bd->telepon }}</td>
                                <td class="p-2 border">{{ $bd->email }}</td>
                                <td class="p-2 border">{{ $bd->created_at }}</td>
                                <td class="p-2 border">{{ $bd->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('bdh.delete', $bd->nip) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('bdh.updateview', $bd->nip) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <div class="flex justify-between">
                    <h1>Jenis Biaya</h1>
                    <a href="{{ route('jenis.createview') }}">Tambah</a>
                </div>
                <table>
                    <thead>
                        <th class="p-2 border">id</th>
                        <th class="p-2 border">nama</th>
                        <th class="p-2 border">jumlah_biaya</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($datajenisbiaya as $jn)
                            <tr>
                                <td class="p-2 border">{{ $jn->id }}</td>
                                <td class="p-2 border">{{ $jn->nama }}</td>
                                <td class="p-2 border">{{ $jn->jumlah_biaya }}</td>
                                <td class="p-2 border">{{ $jn->created_at }}</td>
                                <td class="p-2 border">{{ $jn->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('jenis.delete', $jn->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('jenis.updateview', $jn->id) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h1>Pembayaran</h1>
                <a href="">Tambah</a>
                <table>
                    <thead>
                        <th class="p-2 border">id</th>
                        <th class="p-2 border">tgl_pembayaran</th>
                        <th class="p-2 border">jumlah_pembayaran</th>
                        <th class="p-2 border">nim</th>
                        <th class="p-2 border">nip</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($datapembayaran as $pb)
                            <tr>
                                <td class="p-2 border">{{ $pb->id }}</td>
                                <td class="p-2 border">{{ $pb->tgl_pembayaran }}</td>
                                <td class="p-2 border">{{ $pb->jumlah_pembayaran }}</td>
                                <td class="p-2 border">{{ $pb->nim }}</td>
                                <td class="p-2 border">{{ $pb->nip }}</td>
                                <td class="p-2 border">{{ $pb->created_at }}</td>
                                <td class="p-2 border">{{ $pb->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('prodi.delete', $dp->id_prodi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('prodi.updateview', $dp->id_prodi) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h1>Detail Pembayaran</h1>
                <a href="">Tambah</a>
                <table>
                    <thead>
                        <th class="p-2 border">noreg</th>
                        <th class="p-2 border">id</th>
                        <th class="p-2 border">jumlahbiaya</th>
                        <th class="p-2 border">created_at</th>
                        <th class="p-2 border">updated_at</th>
                        <th class="p-2 border">Aksi</th>
                    </thead>
                        
                    <tbody>
                        @foreach ($datadetail as $dt)
                            <tr>
                                <td class="p-2 border">{{ $dt->noreg }}</td>
                                <td class="p-2 border">{{ $dt->id }}</td>
                                <td class="p-2 border">{{ $dt->jumlahbiaya }}</td>
                                <td class="p-2 border">{{ $dt->created_at }}</td>
                                <td class="p-2 border">{{ $dt->updated_at }}</td>
                                <td class="p-2 border">
                                    <form class="text-red-400" action="{{ route('prodi.delete', $dp->id_prodi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE') 
                                        <button class="" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('prodi.updateview', $dp->id_prodi) }}">Ubah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>