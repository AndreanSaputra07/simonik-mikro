@extends('layout.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Data Pengajuan Untuk Analisis</h3>
            <p class="text-muted">Daftar pengajuan kredit yang perlu dianalisis oleh analis</p>
        </div>
    </div>


    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">List Pengajuan Kredit</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nama Nasabah</th>
                            <th>Jumlah Pengajuan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pengajuans as $p)
                        <tr>

                            <td class="fw-semibold">
                                {{ $p->nasabah->nama }}
                            </td>

                            <td>
                                <span class="badge bg-success fs-6">
                                    Rp {{ number_format($p->jumlah,0,',','.') }}
                                </span>
                            </td>

                            <td>

                                <a href="{{ route('analyst.analisis.create',$p->id) }}"
                                   class="btn btn-warning btn-sm shadow-sm">

                                   Analisis

                                </a>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                Belum ada data pengajuan
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection