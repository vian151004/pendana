<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Galang Dana</title>

    <link rel="stylesheet" href="{{ public_path('/AdminLTE/dist/css/adminlte.min.css') }}">
</head>
<body>
    <h3 class="text-center">Laporan Penggalangan Dana</h3>
    <p class="text-center">
        Tanggal {{ tanggal_indonesia($start) }}
        s/d {{ tanggal_indonesia($end) }}
    </p>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Tanggal</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Sisa Kas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $k => $col)
                        <td {!! $k > 1 ? 'class="text-right"' : '' !!}>{!! $col !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>