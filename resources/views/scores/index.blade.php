@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Penilaian Alternatif</h1>
        <p class="text-muted mb-0">
            Input nilai setiap alternatif terhadap setiap kriteria.
        </p>
    </div>
    <div class="mb-3 d-flex flex-wrap gap-2">
    @if(auth()->user()->isAdmin())
    <a href="{{ route('criteria.index') }}" class="btn btn-outline-primary">Data Kriteria</a>
    @endif
    <a href="{{ route('alternatives.index') }}" class="btn btn-outline-success">Data Alternatif</a>
    <a href="{{ route('calculations.index') }}" class="btn btn-outline-dark">Lihat Hasil SMART</a>
    </div>
    @if($alternatives->isEmpty())
        <div class="alert alert-warning">
            Data alternatif belum tersedia. Silakan tambahkan data alternatif terlebih dahulu.
        </div>
    @endif

    @if($criteria->isEmpty())
        <div class="alert alert-warning">
            Data kriteria belum tersedia. Silakan tambahkan data kriteria terlebih dahulu.
        </div>
    @endif

    @if(!$alternatives->isEmpty() && !$criteria->isEmpty())
        <div class="card table-card">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="fw-bold mb-1">Matriks Penilaian</h5>
                    <p class="text-muted mb-0">
                        Isi nilai numerik untuk setiap kombinasi alternatif dan kriteria.
                    </p>
                </div>

                <form action="{{ route('scores.store') }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th width="60">No</th>
                                    <th width="120">Kode</th>
                                    <th width="220">Alternatif</th>
                                    @foreach($criteria as $criterion)
                                        <th style="min-width: 180px;">
                                            <div class="fw-bold">{{ $criterion->code }}</div>
                                            <div>{{ $criterion->name }}</div>
                                            <small class="d-block text-dark">
                                                Tipe: {{ ucfirst($criterion->type) }}
                                            </small>
                                            <small class="d-block text-dark">
                                                Bobot: {{ $criterion->weight }}
                                            </small>
                                        </th>
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
                                            @php
                                                $key = $alternative->id . '-' . $criterion->id;
                                                $rawVal = $scores[$key]->value ?? null;
                                                $existingValue = '';
                                                if ($rawVal !== null) {
                                                    $cleanVal = rtrim(rtrim(sprintf('%.4f', $rawVal), '0'), '.');
                                                    $parts = explode('.', $cleanVal);
                                                    $parts[0] = number_format($parts[0], 0, '', '.');
                                                    $existingValue = implode(',', $parts);
                                                }
                                            @endphp
                                            <td>
                                                <input
                                                    type="text"
                                                    name="scores[{{ $alternative->id }}][{{ $criterion->id }}]"
                                                    class="form-control @error('scores.' . $alternative->id . '.' . $criterion->id) is-invalid @enderror"
                                                    value="{{ old('scores.' . $alternative->id . '.' . $criterion->id, $existingValue) }}"
                                                    placeholder="Nilai"
                                                    {{ !auth()->user()->isAdmin() ? 'readonly' : '' }}
                                                    oninput="formatIndonesianNumber(this)"
                                                >
                                                @error('scores.' . $alternative->id . '.' . $criterion->id)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-3">
                        @if(auth()->user()->isAdmin())
                        <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                        @endif
                        <a href="{{ route('calculations.index') }}" class="btn btn-success">Hitung SMART</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card table-card mt-4">
            <div class="card-body">
                <h5 class="fw-bold">Catatan Pengisian</h5>
                <ul class="mb-0">
                    <li>Gunakan format angka Indonesia. <strong>Titik (.)</strong> untuk pemisah ribuan, dan <strong>koma (,)</strong> untuk desimal (Contoh: 1.547.800 atau 26,79).</li>
                    <li>Semua kolom penilaian wajib diisi agar perhitungan SMART dapat berjalan.</li>
                    <li>
                        Untuk kriteria bertipe <strong>benefit</strong>, nilai lebih besar akan lebih baik.
                    </li>
                    <li>
                        Untuk kriteria bertipe <strong>cost</strong>, nilai lebih kecil akan lebih baik.
                    </li>
                </ul>
            </div>
        </div>
    @endif

    <script>
        function formatIndonesianNumber(input) {
            let value = input.value;
            // Hanya izinkan angka dan koma
            value = value.replace(/[^\d,]/g, '');
            
            // Pastikan hanya ada satu koma
            let parts = value.split(',');
            if (parts.length > 2) {
                parts = [parts[0], parts.slice(1).join('')];
            }
            
            // Format bagian ribuan (sebelum koma)
            if (parts[0]) {
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            
            // Set kembali value
            input.value = parts.join(',');
        }
    </script>
@endsection