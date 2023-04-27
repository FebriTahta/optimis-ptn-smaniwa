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
                <th rowspan="3" colspan="3">REPORT RATING SISWA <br> 
                    <small>PERIODE : {{$periode}}</small></th>
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
                <th rowspan="2" style="width: 200px; border: solid">NAMA</th>
                <th rowspan="2" style="border: solid">KELAS</th>
                <th rowspan="2" style="border: solid">STATUS</th>
                <th rowspan="2" >PILIHAN 1</th>
                <th rowspan="2" >PILIHAN 2</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->siswa_name }}</td>
                    <td>{{ $kelas[$key]}}</td>
                    <td>{{ $status[$key]}}</td>
                    <td>{{ $pilihan_1[$key]}}</td>
                    <td>{{ $pilihan_2[$key]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>