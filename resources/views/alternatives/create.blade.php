@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Tambah Alternatif</h1>
        <p class="text-muted mb-0">Tambahkan data alternatif strategi pemasaran baru.</p>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <form action="{{ route('alternatives.store') }}" method="POST">
                @csrf

                @include('alternatives._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('alternatives.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection