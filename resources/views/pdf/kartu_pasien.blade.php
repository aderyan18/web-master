<!DOCTYPE html>
<html>

<head>
    <title>Kartu Nama</title>
    <style type="text/css">
        body {
            font-family: Arial;

        }

        td {
            padding: 10px;
        }

        table {}
    </style>
</head>

<body style="color:black;">
    <table border="0" width="80%" cellpadding="0" cellspacing="0" style="font-family: Arial;">
        <tr bgcolor="#19bd9b">
            <th colspan="2">
                <h3>KLINIK AZ ZAHRA</h3>
            </th>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td width="100">No Kartu</td>
            <td width="200">: {{ $pasien->id_register }}</td>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td>Nama Lengkap</td>
            <td>: {{ $pasien->nama }}</td>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td>Jenis Kelamin</td>
            <td>: {{ $pasien->jenis_kelamin }}</td>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td>Pekerjaan</td>
            <td>: {{ $pasien->pekerjaan}}</td>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td>Tanggal Lahir</td>
            <td>: {{ $pasien->tanggal_lahir }}</td>
        </tr>
        <tr bgcolor="#e7e7e7">
            <td>Jenis Pasien</td>
            <td>: {{ $pasien->jenis_pasien }}</td>
        </tr>
        @if($pasien->jenis_pasien=='BPJS')
        <tr bgcolor="#e7e7e7">
            <td>No BPJS</td>
            <td>: {{ $pasien->no_BPJS }}</td>
        </tr>
        @endif
        <tr bgcolor="#19bd9b">
            <td colspan="2" align="center">
                Layanan
                online di aplikasi klinik azzahra <br>
                Username : {{ $pasien->id_register }} Password : {{ $pasien->id_register }}

            </td>
        </tr>
    </table>
</body>

</html>