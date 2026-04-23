@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Data Alternatif</h1>
            <p class="text-muted mb-0">Kelola data alternatif strategi pemasaran yang akan dinilai.</p>
        </div>
        <a href="{{ route('alternatives.create') }}" class="btn btn-primary">
            + Tambah Alternatif
        </a>
    </div>
    <div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('criteria.index') }}" class="btn btn-outline-primary">Ke Data Kriteria</a>
    <a href="{{ route('scores.index') }}" class="btn btn-outline-warning">Ke Penilaian</a>
    <a href="{{ route('calculations.index') }}" class="btn btn-outline-success">Ke Hasil SMART</a>
    </div>
    <div class="card table-card">
        <div class="card-body">
            @if($alternatives->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th width="60">No</th>
                                <th width="120">Kode</th>
                                <th>Nama Alternatif</th>
                                <th>Deskripsi</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatives as $index => $alternative)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center fw-semibold">{{ $alternative->code }}</td>
                                    <td>{{ $alternative->name }}</td>
                                    <td>{{ $alternative->description ?: '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('alternatives.edit', $alternative->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('alternatives.destroy', $alternative->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data alternatif ini?')">
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
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <h5 class="fw-semibold">Belum ada data alternatif</h5>
                    <p class="text-muted">Silakan tambahkan alternatif terlebih dahulu.</p>
                    <a href="{{ route('alternatives.create') }}" class="btn btn-primary">Tambah Alternatif</a>
                </div>
            @endif
        </div>
    </div>
@endsection