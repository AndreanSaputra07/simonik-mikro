@extends('layout.app')

@section('content')

<style>
body{
    background: url('/assets/login.jpg') no-repeat center center/cover;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;
}
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

/* CARD UTAMA */
.glass-card{
    background: rgba(255,255,255,0.95);
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* CARD MARKETING */
.marketing-card{
    background: rgba(255,255,255,0.95);
    border:none;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    transition:0.3s;
}

.marketing-card:hover{
    transform: translateY(-6px);
}

/* TABLE */
.table-modern{
    border-radius:10px;
    overflow:hidden;
}

</style>


<div class="dashboard-overlay">

<h3 class="text-white mb-4">Target Marketing</h3>


{{-- ================= Progress Target Keseluruhan ================= --}}
<div class="card glass-card p-4 mb-4">

<h5 class="mb-4">Progress Target Keseluruhan</h5>

<div class="row align-items-center">

<div class="col-md-4 text-center">
<canvas id="targetChart" height="200"></canvas>
</div>

<div class="col-md-8">

<h2 class="fw-bold text-primary">{{ $progressPercent }}%</h2>

<p class="mb-1">
<strong>Total Target :</strong>  
Rp {{ number_format($totalTarget) }}
</p>

<p class="mb-1">
<strong>Tercapai :</strong>  
Rp {{ number_format($totalSelesai) }}
</p>

<p class="mb-0">
<strong>Sisa :</strong>  
Rp {{ number_format($remainingTarget) }}
</p>

</div>

</div>

</div>



{{-- ================= Tabel Target Marketing ================= --}}

<div class="card glass-card p-4 mb-5">

<h5 class="mb-3">Daftar Target Marketing</h5>

<table class="table table-hover table-modern">

<thead class="table-primary">
<tr>
<th>Marketing</th>
<th>Target</th>
<th>Tahun</th>
<th width="170">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($targets as $t)

<tr>

<td>{{ $t->user->name }}</td>

<td>Rp {{ number_format($t->target_nominal) }}</td>

<td>{{ $t->tahun }}</td>

<td>

<a href="{{ route('target.edit',$t->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('target.delete',$t->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus target?')">

Delete

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>



{{-- ================= Progress Per Marketing ================= --}}

<h4 class="text-white mb-4">Progress Per Marketing</h4>

<div class="row">

@foreach($targets as $index => $t)

<div class="col-md-4 mb-4">

<div class="card marketing-card p-4 text-center">

<h6 class="mb-3 fw-bold">
{{ $t->user->name }}
</h6>

<canvas id="marketingChart{{ $index }}" height="180"></canvas>

<p class="mt-3 mb-1 fw-bold text-primary">
{{ $t->percent }}%
</p>

<small>

Tercapai :  
Rp {{ number_format($t->tercapai) }}

<br>

Target :  
Rp {{ number_format($t->target_nominal) }}

</small>

</div>

</div>

@endforeach

</div>

</div>

@endsection



@section('scripts')

<script>

// ================= Progress Target Keseluruhan =================

const targetCanvas = document.getElementById('targetChart');

if(targetCanvas){

new Chart(targetCanvas,{

type:'doughnut',

data:{
labels:['Tercapai','Sisa'],
datasets:[{
data:[{{ $totalSelesai }}, {{ $remainingTarget }}],
backgroundColor:[
'rgba(0,91,170,0.9)',
'rgba(220,220,220,0.4)'
],
borderWidth:1
}]
},

options:{
responsive:true,
cutout:'70%',
plugins:{legend:{position:'bottom'}}
}

});

}



// ================= Progress Per Marketing =================

@foreach($targets as $index => $t)

const ctx{{ $index }} = document.getElementById('marketingChart{{ $index }}');

if(ctx{{ $index }}){

new Chart(ctx{{ $index }},{

type:'doughnut',

data:{
labels:['Tercapai','Sisa'],
datasets:[{
data:[{{ $t->tercapai }}, {{ $t->sisa }}],
backgroundColor:[
'rgba(0,91,170,0.9)',
'rgba(220,220,220,0.4)'
],
borderWidth:1
}]
},

options:{
responsive:true,
cutout:'70%',
plugins:{legend:{display:false}}
}

});

}

@endforeach

</script>

@endsection