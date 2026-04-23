@extends('layouts.app')

@section('content')
    <div class="hero-box p-4 p-md-5 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">Sistem Pendukung Keputusan Metode SMART</h1>
                <p class="mb-0">
                    Aplikasi ini membantu user menentukan strategi pemasaran terbaik secara objektif
                    berdasarkan kriteria, bobot, dan hasil perhitungan SMART.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('calculations.index') }}" class="btn btn-light btn-lg">
                    Lihat Hasil SMART
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h2 class="main-title h3 mb-1">Dashboard</h2>
        <p class="subtitle mb-0">Ringkasan data sistem pendukung keputusan.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-white p-4">
                <div class="small-muted mb-2">Total Kriteria</div>
                <div class="stat-value text-primary">{{ $totalCriteria }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card bg-white p-4">
                <div class="small-muted mb-2">Total Alternatif</div>
                <div class="stat-value text-success">{{ $totalAlternatives }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card bg-white p-4">
                <div class="small-muted mb-2">Nilai Tersimpan</div>
                <div class="stat-value text-danger">{{ $totalScores }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card bg-white p-4">
                <div class="small-muted mb-2">Kelengkapan Penilaian</div>
                <div class="stat-value text-dark">{{ $completionPercentage }}%</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-clean bg-white p-4 h-100">
                <div class="section-title mb-3">Alur Penggunaan Sistem</div>
                <ol class="mb-0">
                    <li class="mb-2">Input data kriteria dan bobot.</li>
                    <li class="mb-2">Input data alternatif strategi pemasaran.</li>
                    <li class="mb-2">Isi nilai setiap alternatif terhadap semua kriteria.</li>
                    <li class="mb-2">Buka halaman hasil SMART untuk melihat utility dan ranking.</li>
                    <li>Sistem akan merekomendasikan alternatif terbaik secara otomatis.</li>
                </ol>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-clean bg-white p-4 h-100">
                <div class="section-title mb-3">Status Data</div>
                <p class="mb-2"><strong>Nilai yang seharusnya ada:</strong> {{ $expectedScores }}</p>
                <p class="mb-2"><strong>Nilai yang sudah diinput:</strong> {{ $totalScores }}</p>

                @if($completionPercentage >= 100)
                    <div class="alert alert-success mb-0">
                        Semua data penilaian sudah lengkap. Sistem siap menampilkan hasil SMART.
                    </div>
                @elseif($expectedScores == 0)
                    <div class="alert alert-warning mb-0">
                        Tambahkan kriteria dan alternatif terlebih dahulu.
                    </div>
                @else
                    <div class="alert alert-warning mb-0">
                        Data penilaian belum lengkap. Lengkapi semua nilai agar hasil SMART bisa dihitung sempurna.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection