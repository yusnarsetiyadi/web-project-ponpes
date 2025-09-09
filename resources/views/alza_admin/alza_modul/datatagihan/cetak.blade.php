<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pembayaran</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; }
        .info, .footer { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 5px; vertical-align: top; }
    </style>
</head>
<body>
    <h2>Bukti Pembayaran</h2>
    <hr>
    <div class="info">
        <table>
            <tr>
                <td width="30%">Nama Santri</td>
                <td>: {{ $tagihan->santri->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>: {{ $tagihan->santri->jurusan->nama }}</td>
            </tr>
            <tr>
                <td>Pembayaran</td>
                <td>: {{ $tagihan->pembayaran->nama }}</td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>: Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bulan</td>
                <td>: {{ $bulan[(int) $tagihan->bulan] ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>: {{ $tagihan->tahun }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <strong>LUNAS</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
    </div>
</body>
</html>
