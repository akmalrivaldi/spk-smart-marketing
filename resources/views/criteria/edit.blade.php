@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Edit Kriteria</h1>
        <p class="text-muted mb-0">Perbarui data kriteria yang sudah ada.</p>
    </div>

    <div class="card table-card">
        <div class="card-body">
            <form action="{{ route('criteria.update', $criterion->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('criteria._form')

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection