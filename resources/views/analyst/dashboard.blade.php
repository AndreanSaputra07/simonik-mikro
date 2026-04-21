@extends('layout.app')

@section('content')

<style>

/* OVERLAY BIRU SEPERTI DASHBOARD MANAGER */
.dashboard-overlay{
    background: linear-gradient(
        rgba(0,60,113,0.85),
        rgba(0,60,113,0.75)
    );
    backdrop-filter: blur(5px);
    min-height:100vh;
    padding:40px;
}

/* CARD STATISTIK */
.stat-card{
    border:none;
    border-radius:15px;
    padding:25px;
    text-align:center;
    color:white;
    box-shadow:0 6px 20px rgba(0,0,0,0.3);
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

/* WARNA CARD */
.bg-analisis{
    background:linear-gradient(135deg,#ff6b6b,#ff8787);
}

.bg-survey{
    background:linear-gradient(135deg,#ffd43b,#fab005);
}

.bg-approve{
    background:linear-gradient(135deg,#339af0,#1971c2);
}

.bg-realisasi{
    background:linear-gradient(135deg,#20c997,#0ca678);
}

/* CARD CHART */
.chart-card{
    border:none;
    border-radius:15px;
    padding:25px;
    box-shadow:0 6px 20px rgba(0,0,0,0.3);
}

</style>


<div class="dashboard-overlay">

<div class="container-fluid">

{{-- HEADER --}}
<div class="row mb-4">
<div class="col-md-12 text-white">
<h3 class="fw-bold">Dashboard Analyst</h3>
<p>Monitoring proses analisis kredit nasabah</p>
</div>
</div>


{{-- STATISTIK --}}
<div class="row mb-4">

<div class="col-md-3 mb-3">
<div class="stat-card bg-survey">
<h6>Survey</h6>
<h2>{{ $survey ?? 0 }}</h2>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card bg-analisis">
<h6>Analisis</h6>
<h2>{{ $analisis ?? 0 }}</h2>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card bg-approve">
<h6>Approved</h6>
<h2>{{ $approved ?? 0 }}</h2>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card bg-realisasi">
<h6>Realisasi</h6>
<h2>{{ $realisasi ?? 0 }}</h2>
</div>
</div>

</div>


{{-- CHART --}}
<div class="card chart-card">

<h5 class="mb-3">Statistik Proses Kredit Tahun {{ $year }}</h5>

@include('components.chart')

</div>

</div>

</div>

@endsection