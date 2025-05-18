<!DOCTYPE html>
<html>

<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .footer {
            text-align: right;
            font-size: 12px;
            margin-top: 30px;
        }

        .info-table {
            margin-bottom: 20px;
            width: 100%;
        }

        .info-table td {
            border: none;
            padding: 3px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">Laporan Absensi Peserta</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="30%">Nama Materi</td>
            <td>: {{ $materi->nama }}</td>
        </tr>
        <tr>
            <td>Deskripsi Materi</td>
            <td>: {{ $materi->deskripsi ?? '-' }}</td>
        </tr>
        <tr>
            <td>Total Peserta</td>
            <td>: {{ $allPesertas->count() }}</td>
        </tr>
        <tr>
            <td>Total Hadir</td>
            <td>: {{ $totalHadir }}</td>
        </tr>
        <tr>
            <td>Total Tidak Hadir</td>
            <td>: {{ $totalTidakHadir }}</td>
        </tr>

    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Asal Delegasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allPesertas as $index => $peserta)
                @php
                    $absensi = $materi->absensis->firstWhere('peserta_id', $peserta->id);
                    $status = $absensi ? $absensi->status : 'Tidak Hadir';
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->asal_delegasi }}</td>
                    <td style="color: {{ $status == 'Hadir' ? 'green' : 'red' }};">
                        {{ $status }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ $currentDateTime }}
    </div>
</body>

</html>
