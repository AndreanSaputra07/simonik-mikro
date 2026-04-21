@extends('layout.app')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Form Analisis Kredit</h3>
            <p class="text-muted">Halaman analisis pengajuan kredit oleh analis</p>
        </div>
    </div>

    <div class="row">

        {{-- ================= INFO NASABAH ================= --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Informasi Nasabah</h6>
                </div>

                <div class="card-body">

                    <p class="mb-2">
                        <strong>Nama Nasabah</strong><br>
                        {{ $pengajuan->nasabah->nama }}
                    </p>

                    <p class="mb-2">
                        <strong>Jumlah Pengajuan</strong><br>
                        <span class="text-success fw-bold">
                            Rp {{ number_format($pengajuan->jumlah,0,',','.') }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Jenis Kredit</strong><br>
                        {{ $pengajuan->jenis_kredit }}
                    </p>

                    <p class="mb-0">
                        <strong>Tenor</strong><br>
                        {{ $pengajuan->tenor }} Bulan
                    </p>

                </div>

            </div>

        </div>


        {{-- ================= FORM ANALISIS ================= --}}
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Input Hasil Analisis</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route('analyst.analisis.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Rekomendasi Analis
                            </label>

                            <select name="rekomendasi" class="form-select" required>
                                <option value="">-- Pilih Rekomendasi --</option>
                                <option value="layak">Layak</option>
                                <option value="tidak_layak">Tidak Layak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Hasil Analisis
                            </label>

                            <textarea 
                                name="hasil_analisis"
                                rows="5"
                                class="form-control"
                                placeholder="Masukkan hasil analisis kelayakan kredit..."
                                required
                            ></textarea>
                        </div>

                        <div class="d-flex justify-content-end">

                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                Simpan Analisis
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection