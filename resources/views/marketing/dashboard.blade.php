@extends('layout.app')

@section('content')

<div class="container-fluid">

<h4 class="mb-4 fw-bold">Dashboard Marketing</h4>

{{-- KPI --}}
<div class="row g-4 mb-4">

    <div class="col-md-6">
        <div class="card shadow-sm border-0 stat-card">
            <div class="card-body">
                <h6 class="text-muted">Total Pengajuan</h6>
                <h3 class="fw-bold text-primary">
                    Rp {{ number_format($totalPengajuan) }}
                </h3>
                <small class="text-muted">Total pengajuan nasabah</small>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0 stat-card">
            <div class="card-body">
                <h6 class="text-muted">Total Pencairan</h6>
                <h3 class="fw-bold text-success">
                    Rp {{ number_format($totalPencairan) }}
                </h3>
                <small class="text-muted">Dana yang sudah dicairkan</small>
            </div>
        </div>
    </div>

</div>

{{-- ALERT TARGET --}}
<div class="alert alert-{{ $alert['type'] }} shadow-sm">
    <strong>Status Target:</strong> {{ $alert['msg'] }}
</div>

{{-- TARGET PROGRESS --}}
<div class="card shadow-sm border-0 p-4 mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Progress Target {{ now()->year }}</h5>
        <span class="badge bg-success fs-6">
            {{ $progressPercent }}%
        </span>
    </div>

    <div class="progress progress-modern mb-3">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
             role="progressbar"
             style="width: {{ $progressPercent }}%">
        </div>
    </div>

    <div class="row text-center">

        <div class="col-md-6">
            <div class="target-box">
                <div class="target-label">Total Pencairan</div>
                <div class="target-value text-success">
                    Rp {{ number_format($totalPencairan) }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="target-box">
                <div class="target-label">Target Tahun Ini</div>
                <div class="target-value text-primary">
                    Rp {{ number_format($targetNominal) }}
                </div>
            </div>
        </div>

    </div>

</div>

</div>

{{-- STYLE --}}
<style>

.stat-card{
    border-radius:12px;
}

.target-box{
    background:#f8f9fa;
    padding:15px;
    border-radius:10px;
}

.target-label{
    font-size:14px;
    color:#888;
}

.target-value{
    font-size:20px;
    font-weight:600;
}

.progress-modern{
    height:20px;
    border-radius:10px;
}

</style>

@endsection