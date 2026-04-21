@extends('layout.app')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold">Laporan Kredit</h3>
            <p class="text-muted">Data laporan pengajuan kredit nasabah</p>
        </div>

        <div class="col-md-6 text-end">
            <a href="{{ route('manager.laporan.export') }}" class="btn btn-warning shadow-sm">
                Export PDF
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Laporan Kredit</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nasabah</th>
                            <th>Marketing</th>
                            <th>Status</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($data as $index => $d)
                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>{{ $d->nasabah->nama }}</strong>
                            </td>

                            <td>{{ $d->user->name }}</td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $d->status }}
                                </span>
                            </td>

                            <td>
                                <strong class="text-primary">
                                    Rp {{ number_format($d->jumlah,0,',','.') }}
                                </strong>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection