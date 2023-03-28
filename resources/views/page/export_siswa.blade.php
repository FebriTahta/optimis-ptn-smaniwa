<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .notel {
        mso-number-format: "\@";
        }
    </style>
</head>
<body>
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="3">DATA SISWA <br> <small></small></th>
            </tr>
        </thead>
    </table>
    <!--  -->
    <table>
        <thead>
            <tr></tr>
        </thead>
    </table>
    <!--  -->
    <table style="border: solid">
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                <th rowspan="2" style="border: solid">NO</th>
                <th rowspan="2" style="width: 100px; border: solid">NIP</th>
                <th rowspan="2" style="width: 200px; border: solid">NAMA</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($siswa as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>