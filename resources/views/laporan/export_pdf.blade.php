<!DOCTYPE html>
<html>
<head>
<style>
body { font-family: Arial; }
</style>
</head>
<body>

<h3>Laporan Kredit SIMONIK</h3>

<table border="1" width="100%" cellpadding="5">
<tr>
    <th>Nasabah</th>
    <th>Status</th>
    <th>Nominal</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->nasabah->nama }}</td>
    <td>{{ $d->status }}</td>
    <td>{{ $d->jumlah }}</td>
</tr>
@endforeach

</table>

</body>
</html>
