@extends('layout.app')

@section('content')

<style>

/* BACKGROUND */
body{
    background: url('/assets/login.jpg') no-repeat center center/cover;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;
}

/* OVERLAY */
.dashboard-overlay{
    background: linear-gradient(
        rgba(0,60,113,0.85),
        rgba(0,60,113,0.75)
    );
    backdrop-filter: blur(5px);
    min-height:100vh;
    padding:40px;
}

/* TITLE */
.dashboard-title{
    color:white;
    font-weight:700;
    letter-spacing:1px;
}

/* STAT CARD */
.stat-card{
    border:none;
    border-radius:18px;
    padding:25px;
    text-align:center;
    background:rgba(255,255,255,0.95);
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}

/* ICON STAT */
.stat-icon{
    font-size:30px;
    margin-bottom:10px;
}

/* NUMBER */
.stat-number{
    font-size:30px;
    font-weight:700;
    color:#003C71;
}

/* CHART CARD */
.chart-card{
    border:none;
    border-radius:18px;
    background:rgba(255,255,255,0.95);
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

</style>


<div class="dashboard-overlay">

<h2 class="dashboard-title mb-4">
📊 Dashboard Manager
</h2>

<div class="row mb-4 g-4">

<!-- NASABAH -->
<div class="col-md-4">
<div class="stat-card">

<div class="stat-icon">👥</div>

<h6>Total Nasabah</h6>

<div class="stat-number">
{{ $totalNasabah }}
</div>

</div>
</div>


<!-- PENGAJUAN -->
<div class="col-md-4">
<div class="stat-card">

<div class="stat-icon">📄</div>

<h6>Total Pengajuan</h6>

<div class="stat-number">
{{ number_format($totalPengajuan) }}
</div>

</div>
</div>


<!-- PENCAIRAN -->
<div class="col-md-4">
<div class="stat-card">

<div class="stat-icon">💰</div>

<h6>Total Pencairan</h6>

<div class="stat-number">
Rp {{ number_format($totalPencairan) }}
</div>

</div>
</div>

</div>


<!-- CHART BULANAN -->
<div class="chart-card mb-4">

<h5 class="mb-3">
📈 Pengajuan Per Bulan Tahun {{ $year }}
</h5>

<canvas id="monthlyChart" height="100"></canvas>

</div>


<!-- CHART TAHUNAN -->
<div class="chart-card">

<h5 class="mb-3">
📊 Pengajuan Per Tahun
</h5>

<canvas id="annualChart" height="100"></canvas>

</div>

</div>

@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const monthCtx = document.getElementById('monthlyChart').getContext('2d');
const annualCtx = document.getElementById('annualChart').getContext('2d');

const monthLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];


// CHART BULANAN
const monthData = {
labels: monthLabels,
datasets: [
@foreach($monthlyChart as $dataset)
{
label:'{{ $dataset['label'] }}',
data:[{{ implode(',', $dataset['data']) }}],
backgroundColor:'rgba(0,123,255,0.7)',
borderRadius:5
},
@endforeach
]
};

new Chart(monthCtx,{
type:'bar',
data:monthData,
options:{
responsive:true,
plugins:{
legend:{position:'top'}
},
scales:{
y:{beginAtZero:true}
}
}
});



// CHART TAHUNAN
const annualLabels=[@foreach($years as $y) {{ $y }}, @endforeach];

const annualDataSets=[
@foreach($annualChart as $dataset)
{
label:'{{ $dataset['label'] }}',
data:[{{ implode(',', $dataset['data']) }}],
backgroundColor:'rgba(255,193,7,0.8)',
borderRadius:5
},
@endforeach
];

new Chart(annualCtx,{
type:'bar',
data:{labels:annualLabels,datasets:annualDataSets},
options:{
responsive:true,
plugins:{
legend:{position:'top'}
},
scales:{
y:{beginAtZero:true}
}
}
});

</script>

@endsection