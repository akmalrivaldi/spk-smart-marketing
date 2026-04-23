@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Data Kriteria</h1>
            <p class="text-muted mb-0">Kelola data kriteria, bobot, dan tipe benefit/cost.</p>
        </div>
        <a href="{{ route('criteria.create') }}" class="btn btn-primary">
            + Tambah Kriteria
        </a>
    </div>
    <div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('alternatives.index') }}" class="btn btn-outline-success">Ke Data Alternatif</a>
    <a href="{{ route('scores.index') }}" class="btn btn-outline-warning">Ke Penilaian</a>
    <a href="{{ route('calculations.index') }}" class="btn btn-outline-primary">Ke Hasil SMART</a>
    </div>
    <div class="card table-card">
        <div class="card-body">
            @if($criteria->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th width="60">No</th>
                                <th width="120">Kode</th>
                                <th>Nama Kriteria</th>
                                <th width="120">Tipe</th>
                                <th width="120">Bobot</th>
                                <th width="150">Bobot Normalisasi</th>
                                <th>Deskripsi</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalWeight = $criteria->sum('weight');
                            @endphp

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
                                    <td class="text-center">
                                        {{ $totalWeight > 0 ? number_format($criterion->weight / $totalWeight, 4) : '0.0000' }}
                                    </td>
                                    <td>{{ $criterion->description ?: '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('criteria.destroy', $criterion->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data kriteria ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="table-light">
                            <tr>
                                <th colspan="4" class="text-end">Total Bobot</th>
                                <th class="text-center">{{ $totalWeight }}</th>
                                <th class="text-center">
                                    {{ $totalWeight > 0 ? number_format($criteria->sum(fn($item) => $item->weight / $totalWeight), 4) : '0.0000' }}
                                </th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <h5 class="fw-semibold">Belum ada data kriteria</h5>
                    <p class="text-muted">Silakan tambahkan kriteria terlebih dahulu.</p>
                    <a href="{{ route('criteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>
                </div>
            @endif
        </div>
    </div>
@endsection