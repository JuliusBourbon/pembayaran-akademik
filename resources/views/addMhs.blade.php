<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <form class="flex flex-col justify-center items-center" action="{{ route('mhs.store') }}" method="POST">
        <h1 class="text-xl">Form Mahasiswa</h1>
        @csrf
        <div class="flex flex-col border p-5 gap-2">
            <input class="border p-1" type="text" name="nama" placeholder="Nama Mahasiswa" required>
            <input class="border p-1" type="text" name="alamat" placeholder="Alamat" required>
            <input class="border p-1" type="text" name="telepon" placeholder="Telepon" required>
            <input class="border p-1" type="text" name="telepon_ortu" placeholder="Telepon Orang Tua" required>
            <input class="border p-1" type="text" name="user" placeholder="Username" required>
            <input class="border p-1" type="text" name="password" placeholder="Password" required>
            <input class="border p-1" type="text" name="email" placeholder="Email" required>
            <input class="border p-1" type="text" name="virtual_account" placeholder="Virtual Account" required>
            <select class="border p-1" name="id_prodi" id="">
                @foreach ($dataprodi as $pd)
                    <option value="{{ $pd->id_prodi }}">
                        {{ $pd->nama_prodi }}
                    </option>
                @endforeach
            </select>
    
            <select class="border p-1" name="id_fakultas" id="">
                @foreach ($datafakultas as $fk)
                    <option value="{{ $fk->id_fakultas }}">
                        {{ $fk->nama_fakultas }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>