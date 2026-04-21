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

/* CARD FORM */
.form-card{
    background: rgba(255,255,255,0.95);
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

</style>


<div class="dashboard-overlay">

<h3 class="text-white mb-4">Edit Target Marketing</h3>

<div class="card form-card p-4 col-md-6">

<form method="POST" action="{{ route('target.update',$target->id) }}">

@csrf
@method('PUT')

<div class="mb-3">

<label class="form-label fw-semibold">Marketing</label>

<select name="user_id" class="form-control">

@foreach($marketing as $m)

<option value="{{ $m->id }}" 
{{ $target->user_id==$m->id?'selected':'' }}>

{{ $m->name }}

</option>

@endforeach

</select>

</div>



<div class="mb-3">

<label class="form-label fw-semibold">Target Nominal</label>

<input type="number"
name="target_nominal"
value="{{ $target->target_nominal }}"
class="form-control">

</div>



<div class="mb-3">

<label class="form-label fw-semibold">Tahun</label>

<input type="number"
name="tahun"
value="{{ $target->tahun }}"
class="form-control">

</div>



<div class="mt-4">

<button class="btn btn-primary">

Update Target

</button>

<a href="{{ url()->previous() }}" class="btn btn-secondary">

Kembali

</a>

</div>

</form>

</div>

</div>

@endsection