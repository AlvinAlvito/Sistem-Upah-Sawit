<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Gaji Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Gaji dan Bonus Pegawai</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pegawai->nama }}</td>
                    <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->bonus_nominal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->total_upah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
