@extends('layout.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar Pengajuan Kredit</h4>

    <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">
        + Tambah Pengajuan
    </a>
</div>


<div class="card shadow-sm border-0">
<div class="card-body p-4">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">
<tr>
<th>ID</th>
<th>Nasabah</th>
<th>Jenis Kredit</th>
<th>Jumlah</th>
<th>Status</th>
<th width="150">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($pengajuans as $pengajuan)
<tr>

<td class="fw-semibold">
#{{ $pengajuan->id }}
</td>

<td>
{{ $pengajuan->nasabah->nama ?? '-' }}
</td>

<td>
<span class="badge bg-info text-dark">
{{ $pengajuan->jenis_kredit }}
</span>
</td>

<td class="fw-semibold">
Rp {{ number_format($pengajuan->jumlah) }}
</td>

<td>

{{-- STATUS BADGE --}}
@if($pengajuan->status == 'pending')
<span class="badge bg-secondary">Pending</span>

@elseif($pengajuan->status == 'survey')
<span class="badge bg-warning text-dark">Survey</span>

@elseif($pengajuan->status == 'analisis')
<span class="badge bg-info">Analisis</span>

@elseif($pengajuan->status == 'diterima')
<span class="badge bg-success">Approved</span>

@elseif($pengajuan->status == 'realisasi')
<span class="badge bg-primary">Realisasi</span>

@elseif($pengajuan->status == 'pencairan')
<span class="badge bg-success">Pencairan</span>

@else
<span class="badge bg-dark">
{{ $pengajuan->status }}
</span>
@endif

</td>

<td>

<div class="d-flex gap-1">

<a href="{{ route('pengajuan.edit',$pengajuan->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('pengajuan.destroy',$pengajuan->id) }}"
method="POST"
onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Hapus
</button>

</form>

</div>

</td>

</tr>
@endforeach

</tbody>

</table>

</div>
</div>
</div>

</div>

@endsection