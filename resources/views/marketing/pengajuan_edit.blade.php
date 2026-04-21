@extends('layout.app')

@section('content')

<div class="container">

<h4 class="mb-4 fw-bold">Edit Pengajuan Kredit</h4>

<div class="card shadow-sm border-0">
<div class="card-body p-4">

<form method="POST" action="{{ url('/marketing/pengajuan/'.$pengajuan->id) }}">
@csrf
@method('PUT')

<div class="row">

{{-- NASABAH --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Nama Nasabah</label>

<input type="text"
class="form-control"
value="{{ $pengajuan->nasabah->nama }}"
readonly>

<small class="text-muted">
Nasabah tidak dapat diubah pada pengajuan ini
</small>
</div>


{{-- JENIS KREDIT --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Jenis Kredit</label>

<input type="text"
class="form-control"
value="{{ $pengajuan->jenis_kredit }}"
readonly>
</div>


{{-- JUMLAH PENGAJUAN --}}
<div class="col-md-12 mb-3">
<label class="form-label fw-semibold">Jumlah Pengajuan</label>

<input
type="number"
name="jumlah"
value="{{ $pengajuan->jumlah }}"
class="form-control"
placeholder="Masukkan jumlah pengajuan">

<small class="text-muted">
Contoh: 10000000
</small>
</div>

</div>


{{-- BUTTON --}}
<div class="mt-3 d-flex justify-content-end gap-2">

<a href="{{ url()->previous() }}" class="btn btn-light">
Batal
</a>

<button class="btn btn-primary px-4">
Update Pengajuan
</button>

</div>

</form>

</div>
</div>

</div>

@endsection