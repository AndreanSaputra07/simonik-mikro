@extends('layout.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Form Survey Lapangan</h3>
            <p class="text-muted">
                Input hasil survey untuk pengajuan kredit nasabah
            </p>
        </div>
    </div>


    <div class="row">

        {{-- INFO NASABAH --}}
        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    Informasi Nasabah
                </div>

                <div class="card-body">

                    <p class="mb-2">
                        <strong>Nama Nasabah</strong>
                    </p>

                    <p class="fs-5 fw-semibold text-primary">
                        {{ $pengajuan->nasabah->nama }}
                    </p>

                    <hr>

                    <p class="mb-2">
                        <strong>Jumlah Pengajuan</strong>
                    </p>

                    <p class="fs-5 fw-bold text-success">
                        Rp {{ number_format($pengajuan->jumlah) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM SURVEY --}}
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning fw-semibold">
                    Input Hasil Survey
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('analyst.survey.store') }}">
                        @csrf

                        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                        {{-- HASIL SURVEY --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Hasil Survey
                            </label>

                            <textarea 
                                name="hasil_survey" 
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan hasil survey lapangan..."
                                required
                            ></textarea>
                        </div>


                        {{-- KETERANGAN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Keterangan Tambahan
                            </label>

                            <textarea 
                                name="keterangan" 
                                class="form-control"
                                rows="3"
                                placeholder="Tambahkan catatan jika diperlukan..."
                            ></textarea>
                        </div>


                        {{-- KEPUTUSAN --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Keputusan Survey
                            </label>

                            <select name="keputusan" class="form-select" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="lolos">Lolos Survey</option>
                                <option value="tidak">Tidak Lolos</option>
                            </select>
                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <button class="btn btn-warning px-4">
                                Simpan Survey
                            </button>

                            <a href="{{ url()->previous() }}" 
                               class="btn btn-outline-secondary">
                               Kembali
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection