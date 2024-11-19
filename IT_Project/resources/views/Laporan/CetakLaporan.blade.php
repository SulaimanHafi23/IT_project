<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Laporan</h1>
    @if($tanggal_laporan)
        <p>Tanggal Laporan: {{ $tanggal_laporan }}</p>
    @else
        <p>Semua Data Laporan</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Laporan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $item->Id_Laporan }}</td>
                    <td>{{ $item->tanggal_laporan }}</td>
                    <td>{{ $item->tanggal_mulai }}</td>
                    <td>{{ $item->tanggal_akhir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Cetak halaman setelah halaman selesai dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
