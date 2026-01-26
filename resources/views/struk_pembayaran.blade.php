<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $trx->no_transaksi }}</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 14px; color: #000; }
        .container { width: 100%; max-width: 400px; margin: 0 auto; border: 1px solid #000; padding: 20px; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .info-table { width: 100%; margin-bottom: 10px; }
        .info-table td { vertical-align: top; }
        .rincian-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; border-top: 1px dashed #000; border-bottom: 1px dashed #000; }
        .rincian-table td { padding: 5px 0; }
        .total { font-weight: bold; font-size: 16px; text-align: right; margin-top: 10px; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; border-top: 1px solid #000; padding-top: 5px; }
        
        @media print {
            .no-print { display: none; }
            .container { border: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak Struk</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

    <div class="container">
        <div class="header">
            <h3 style="margin:0;">UNIVERSITAS KOMPUTER</h3>
            <p style="margin:0; font-size: 12px;">BUKTI PEMBAYARAN</p>
            <p style="margin:5px 0; font-size: 12px;">{{ $trx->no_transaksi }}</p>
        </div>

        <table class="info-table">
            <tr>
                <td width="30%">Tgl</td>
                <td>: {{ date('d/m/Y H:i', strtotime($trx->tgl_bayar)) }}</td>
            </tr>
            <tr>
                <td>No. Reg</td>
                <td>: {{ $trx->no_reg }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: {{ $trx->mahasiswa->nama_mhs }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>: {{ $trx->mahasiswa->kode_prodi }}</td>
            </tr>
        </table>

        <table class="rincian-table">
            @foreach($trx->details as $item)
            <tr>
                <td>{{ $item->jenis_biaya }}</td>
                <td align="right">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="total">
            TOTAL BAYAR: Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
        </div>

        <div class="footer">
            <p>Kasir: {{ $trx->petugas->username ?? '-' }}</p>
            <p>Terima Kasih - Simpan Resi Ini Sebagai Bukti Sah</p>
        </div>
    </div>

</body>
</html>