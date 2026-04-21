@extends('layout.app')

@section('content')

<style>

/* OVERLAY SAMA SEPERTI DASHBOARD */
.dashboard-overlay{
    background: linear-gradient(
        rgba(0,60,113,0.85),
        rgba(0,60,113,0.75)
    );
    backdrop-filter: blur(5px);
    min-height:100vh;
    padding:40px;
}

/* CARD MODERN */
.glass-card{
    background: rgba(255,255,255,0.96);
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* TABLE STYLE */
.table thead th{
    font-size:14px;
}

.table tbody tr:hover{
    background:#f5f9ff;
}

/* TITLE */
.section-title{
    color:white;
    font-weight:600;
}

/* EXPORT BUTTON */
.btn-export{
    font-weight:600;
    border-radius:8px;
}

</style>


<div class="dashboard-overlay">

<h3 class="section-title mb-4">Monitoring Pengajuan Nasabah</h3>

<a href="{{ route('manager.export.pengajuan') }}" 
   class="btn btn-success btn-export mb-3">
   Export Excel
</a>

<div class="card glass-card p-4 mb-5">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-primary">
<tr>
<th>Nama Nasabah</th>
<th>Jenis Kredit</th>
<th>Jumlah</th>
<th>Status</th>
<th>Tenor</th>
<th>Marketing</th>
<th>Jenis Usaha</th>
<th>Lama Usaha</th>
</tr>
</thead>

<tbody>

@foreach($pengajuans as $p)

<tr>

<td>{{ $p->nasabah->nama }}</td>

<td>{{ $p->jenis_kredit }}</td>

<td>Rp {{ number_format($p->jumlah) }}</td>

<td>

@if($p->status == 'disetujui')
<span class="badge bg-success">Disetujui</span>

@elseif($p->status == 'ditolak')
<span class="badge bg-danger">Ditolak</span>

@elseif($p->status == 'diproses')
<span class="badge bg-warning text-dark">Diproses</span>

@else
<span class="badge bg-secondary">
{{ ucfirst($p->status) }}
</span>
@endif

</td>

<td>{{ $p->tenor }} bulan</td>

<td>{{ $p->user->name }}</td>

<td>{{ $p->nasabah->jenis_usaha }}</td>

<td>{{ $p->nasabah->lama_usaha }} tahun</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>



{{-- ================= DATA LIST NASABAH POTENSIAL ================= --}}

<h4 class="section-title mb-3">
Data List (Nasabah Potensial)
</h4>

<a href="{{ route('manager.export.datalist') }}" 
   class="btn btn-primary btn-export mb-3">
   Export Excel
</a>

<div class="card glass-card p-4">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-success">
<tr>
<th>Nama Nasabah</th>
<th>Jenis Kredit</th>
<th>Jumlah</th>
<th>Tenor</th>
<th>Marketing</th>
</tr>
</thead>

<tbody>

@foreach($dataList as $d)

<tr>

<td>{{ $d->nasabah->nama }}</td>

<td>{{ $d->jenis_kredit }}</td>

<td>Rp {{ number_format($d->jumlah) }}</td>

<td>{{ $d->tenor }} bulan</td>

<td>{{ $d->user->name }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

@endsection