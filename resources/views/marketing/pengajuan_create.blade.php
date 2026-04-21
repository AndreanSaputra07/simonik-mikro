@extends('layout.app')

@section('content')

<div class="container">

<h4 class="mb-4 fw-bold">Tambah Pengajuan Kredit</h4>

<div class="card shadow-sm border-0">
<div class="card-body p-4">

<form method="POST" action="{{ route('pengajuan.store') }}">
@csrf

<div class="row">

{{-- NASABAH LAMA --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Pilih Nasabah</label>

<select name="nasabah_id" class="form-control form-select">
<option value="">-- Pilih Nasabah Lama --</option>

@foreach($nasabah as $n)
<option value="{{ $n->id }}">
{{ $n->nama }}
</option>
@endforeach

</select>

<small class="text-muted">
Pilih jika nasabah sudah pernah terdaftar
</small>
</div>


{{-- NASABAH BARU --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Nama Nasabah Baru</label>

<input type="text"
name="nama_nasabah_baru"
class="form-control"
placeholder="Isi jika ingin menambahkan nasabah baru">

<small class="text-muted">
Kosongkan jika memilih nasabah lama
</small>
</div>


{{-- JENIS KREDIT --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Jenis Kredit</label>

<select name="jenis_kredit" class="form-select">
<option value="KUR">KUR</option>
<option value="KUM">KUM</option>
</select>
</div>


{{-- JUMLAH --}}
<div class="col-md-6 mb-3">
<label class="form-label fw-semibold">Jumlah Pengajuan</label>

<input type="number"
name="jumlah"
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

<button class="btn btn-warning px-4">
Simpan Pengajuan
</button>

</div>

</form>

</div>
</div>

</div>

@endsection