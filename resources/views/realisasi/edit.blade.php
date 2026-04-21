@extends('layout.app')

@section('content')

<h4>Edit Realisasi</h4>

<form method="POST">
@csrf
@method('PUT')
<input type="number" name="nominal_disetujui"
value="{{ $realisasi->nominal_disetujui }}"
class="form-control mb-3">
<button class="btn btn-primary">Update</button>
</form>

@endsection
