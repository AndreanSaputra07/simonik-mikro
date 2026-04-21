@extends('layout.app')

@section('content')

<h4>Realisasi Kredit</h4>

<form method="POST">
@csrf
<input type="number" name="nominal_disetujui" class="form-control mb-3">
<button class="btn btn-warning">Simpan</button>
</form>

@endsection
