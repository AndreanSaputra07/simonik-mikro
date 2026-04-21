@extends('layout.app')

@section('content')

<div class="container">

<h4 class="fw-bold mb-4">
Target Progress Tahun {{ $tahun }}
</h4>

{{-- KPI SUMMARY --}}
<div class="row mb-4">

<div class="col-md-4">
<div class="card shadow-sm border-0">
<div class="card-body text-center">
<h6 class="text-muted">Target Marketing</h6>
<h4 class="fw-bold text-primary">
Rp {{ number_format($targetNominal) }}
</h4>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm border-0">
<div class="card-body text-center">
<h6 class="text-muted">Total Pencairan</h6>
<h4 class="fw-bold text-success">
Rp {{ number_format($totalRealisasi) }}
</h4>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm border-0">
<div class="card-body text-center">
<h6 class="text-muted">Sisa Target</h6>
<h4 class="fw-bold text-danger">
Rp {{ number_format($targetNominal - $totalRealisasi) }}
</h4>
</div>
</div>
</div>

</div>


{{-- PROGRESS BAR --}}
@php
$percent = $targetNominal > 0 ? round(($totalRealisasi / $targetNominal) * 100,1) : 0;
@endphp

<div class="card shadow-sm border-0 mb-4">
<div class="card-body">

<div class="d-flex justify-content-between mb-2">
<span class="fw-semibold">Progress Target</span>
<span class="fw-bold">{{ $percent }}%</span>
</div>

<div class="progress" style="height:10px;">
<div class="progress-bar bg-success"
style="width: {{ $percent }}%">
</div>
</div>

</div>
</div>



{{-- CHART AREA --}}
<div class="row">

<div class="col-md-6 mb-4">

<div class="card shadow-sm border-0">
<div class="card-body">

<h6 class="fw-semibold mb-3">
Distribusi Target
</h6>

<canvas id="progressChart"></canvas>

</div>
</div>

</div>


<div class="col-md-6 mb-4">

<div class="card shadow-sm border-0">
<div class="card-body">

<h6 class="fw-semibold mb-3">
Pencairan per Bulan
</h6>

<canvas id="monthlyChart"></canvas>

</div>
</div>

</div>

</div>

</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const target = {{ $targetNominal }};
const realisasi = {{ $totalRealisasi }};
const sisa = target - realisasi;


// ===== Doughnut Chart =====
new Chart(document.getElementById('progressChart'), {

type: 'doughnut',

data: {

labels: ['Tercapai','Sisa'],

datasets: [{

data: [realisasi, sisa],

backgroundColor: [
'#28a745',
'#dee2e6'
],

borderWidth: 0

}]

},

options: {

plugins:{
legend:{
position:'bottom'
}
},

cutout:'70%'

}

});




// ===== Data Bulanan =====
const monthlyData = [

@for ($i = 1; $i <= 12; $i++)
{{ $monthly[$i] ?? 0 }},
@endfor

];



new Chart(document.getElementById('monthlyChart'), {

type:'line',

data:{

labels:['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

datasets:[{

label:'Pencairan',

data:monthlyData,

borderColor:'#0d6efd',

backgroundColor:'rgba(13,110,253,0.1)',

fill:true,

tension:0.4,

pointRadius:4

}]

},

options:{

responsive:true,

plugins:{
legend:{display:false}
},

scales:{
y:{
beginAtZero:true
}
}

}

});

</script>

@endsection