@extends('layout.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Realisasi Kredit</h3>
            <p class="text-muted">
                Daftar pengajuan yang siap direalisasikan atau sedang dalam proses pencairan
            </p>
        </div>
    </div>


    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Data Realisasi</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nama Nasabah</th>
                            <th>Jumlah Pengajuan</th>
                            <th width="200">Status / Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pengajuans as $p)

                        <tr>

                            <td class="fw-semibold">
                                {{ $p->nasabah->nama }}
                            </td>

                            <td>
                                <span class="badge bg-success-subtle text-success fw-semibold">
                                    Rp {{ number_format($p->jumlah) }}
                                </span>
                            </td>

                            <td>

                                {{-- STATUS REALISASI --}}
                                @if($p->status == 'realisasi')

                                    <form action="{{ route('analyst.realisasi.proses', $p->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm shadow-sm">
                                            Proses Realisasi
                                        </button>
                                    </form>

                                {{-- STATUS PENCAIRAN --}}
                                @elseif($p->status == 'pencairan')

                                    <span class="badge bg-primary px-3 py-2">
                                        Pencairan
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                Tidak ada data realisasi
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