@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Tambah Kriteria</h1>
        <p class="text-muted mb-0">Tambahkan data kriteria baru untuk proses perhitungan SMART.</p>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <form action="{{ route('criteria.store') }}" method="POST">
                @csrf

                @include('criteria._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection