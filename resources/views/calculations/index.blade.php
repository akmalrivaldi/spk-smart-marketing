@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="main-title h3 mb-1">Hasil Perhitungan SMART</h1>
        <p class="subtitle mb-0">
            Menampilkan bobot normalisasi, nilai utility, nilai akhir, dan ranking rekomendasi.
        </p>
    </div>

    @if(!$isComplete)
        <div class="alert alert-warning card-clean">
            {{ $message }}
        </div>
    @endif

    @if($isComplete && $results->count() > 0)
        @php
            $top1 = $results[0] ?? null;
            $top2 = $results[1] ?? null;
            $top3 = $results[2] ?? null;
        @endphp

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="hero-box p-4 h-100">
                    <div class="small text-white-50 mb-2">Rekomendasi Utama</div>
                    <h2 class="fw-bold mb-2">
                        {{ $top1['alternative_code'] }} - {{ $top1['alternative_name'] }}
                    </h2>
                    <p class="mb-3">
                        Alternatif ini memperoleh nilai akhir tertinggi berdasarkan perhitungan SMART.
                    </p>
                    <div class="fs-4 fw-bold">
                        Nilai Akhir: {{ number_format($top1['score'], 4) }}
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3 h-100">
                    <div class="col-12">
                        <div class="rank-card bg-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small-muted">Peringkat 2</div>
                                    <div class="fw-bold">
                                        {{ $top2 ? $top2['alternative_name'] : '-' }}
                                    </div>
                                </div>
                                <span class="badge badge-rank-2">
                                    {{ $top2 ? number_format($top2['score'], 4) : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="rank-card bg-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small-muted">Peringkat 3</div>
                                    <div class="fw-bold">
                                        {{ $top3 ? $top3['alternative_name'] : '-' }}
                                    </div>
                                </div>
                                <span class="badge badge-rank-3">
                                    {{ $top3 ? number_format($top3['score'], 4) : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="rank-card bg-white p-3">
                            <div class="small-muted mb-1">Jumlah Alternatif Dinilai</div>
                            <div class="fw-bold fs-5">{{ $results->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($criteria->isNotEmpty())
        <div class="card-clean bg-white p-4 mb-4">
            <div class="section-title mb-3">1. Data Kriteria dan Bobot Normalisasi</div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                            <th>Bobot Normalisasi</th>
                            <th>Min</th>
                            <th>Max</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criteria as $index => $criterion)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center fw-semibold">{{ $criterion->code }}</td>
                                <td>{{ $criterion->name }}</td>
                                <td class="text-center">
                                    @if($criterion->type === 'benefit')
                                        <span class="badge bg-success">Benefit</span>
                                    @else
                                        <span class="badge bg-danger">Cost</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $criterion->weight }}</td>
                                <td class="text-center">{{ number_format($normalizedWeights[$criterion->id] ?? 0, 4) }}</td>
                                <td class="text-center">{{ $isComplete ? number_format($minMaxValues[$criterion->id]['min'] ?? 0, 4) : '-' }}</td>
                                <td class="text-center">{{ $isComplete ? number_format($minMaxValues[$criterion->id]['max'] ?? 0, 4) : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th class="text-center">{{ $totalWeight }}</th>
                            <th class="text-center">{{ number_format(collect($normalizedWeights)->sum(), 4) }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif

    @if($isComplete)
        <div class="card-clean bg-white p-4 mb-4">
            <div class="section-title mb-3">2. Ranking Akhir</div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Rank</th>
                            <th>Kode</th>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                            <tr>
                                <td class="text-center fw-bold">{{ $result['rank'] }}</td>
                                <td class="text-center fw-semibold">{{ $result['alternative_code'] }}</td>
                                <td>{{ $result['alternative_name'] }}</td>
                                <td class="text-center fw-bold">{{ number_format($result['score'], 4) }}</td>
                                <td class="text-center">
                                    @if($result['rank'] == 1)
                                        <span class="badge badge-rank-1">Rekomendasi Terbaik</span>
                                    @elseif($result['rank'] == 2)
                                        <span class="badge badge-rank-2">Peringkat 2</span>
                                    @elseif($result['rank'] == 3)
                                        <span class="badge badge-rank-3">Peringkat 3</span>
                                    @else
                                        <span class="badge badge-rank-other">Alternatif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-clean bg-white p-4 mb-4">
            <div class="section-title mb-3">3. Matriks Nilai Awal</div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Alternatif</th>
                            @foreach($criteria as $criterion)
                                <th>{{ $criterion->code }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatives as $index => $alternative)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center fw-semibold">{{ $alternative->code }}</td>
                                <td>{{ $alternative->name }}</td>
                                @foreach($criteria as $criterion)
                                    <td class="text-center">
                                        {{ number_format($rawMatrix[$alternative->id][$criterion->id] ?? 0, 4) }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-clean bg-white p-4 mb-4">
            <div class="section-title mb-3">4. Matriks Nilai Utility</div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Alternatif</th>
                            @foreach($criteria as $criterion)
                                <th>{{ $criterion->code }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alternatives as $index => $alternative)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center fw-semibold">{{ $alternative->code }}</td>
                                <td>{{ $alternative->name }}</td>
                                @foreach($criteria as $criterion)
                                    <td class="text-center">
                                        {{ number_format($utilityMatrix[$alternative->id][$criterion->id] ?? 0, 4) }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-clean bg-white p-4">
            <div class="section-title mb-3">5. Detail Perhitungan per Alternatif</div>

            @foreach($results as $result)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold">
                        {{ $result['alternative_code'] }} - {{ $result['alternative_name'] }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-warning text-center">
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Bobot Normalisasi</th>
                                        <th>Utility</th>
                                        <th>Bobot × Utility</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($result['detail'] as $detail)
                                        <tr>
                                            <td>{{ $detail['criterion_code'] }} - {{ $detail['criterion_name'] }}</td>
                                            <td class="text-center">{{ number_format($detail['weight'], 4) }}</td>
                                            <td class="text-center">{{ number_format($detail['utility'], 4) }}</td>
                                            <td class="text-center">{{ number_format($detail['weighted_value'], 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="3" class="text-end">Total Nilai Akhir</th>
                                        <th class="text-center">{{ number_format($result['score'], 4) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection