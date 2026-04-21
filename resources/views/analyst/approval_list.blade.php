@extends('layout.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Approval Pengajuan Kredit</h3>
            <p class="text-muted">
                Daftar pengajuan kredit yang menunggu persetujuan
            </p>
        </div>
    </div>


    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Approval List</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nama Nasabah</th>
                            <th width="250">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pengajuans as $p)

                        <tr>

                            <td class="fw-semibold">
                                {{ $p->nasabah->nama }}
                            </td>

                            <td>

                                <a href="{{ route('analyst.approve',$p->id) }}"
                                   class="btn btn-success btn-sm shadow-sm me-2">

                                    Approve
                                </a>

                                <a href="{{ route('analyst.reject',$p->id) }}"
                                   class="btn btn-danger btn-sm shadow-sm">

                                    Reject
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="2" class="text-center text-muted py-4">
                                Tidak ada pengajuan yang menunggu approval
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