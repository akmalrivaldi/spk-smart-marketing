<div class="row g-3">
    <div class="col-md-6">
        <label for="code" class="form-label">Kode Kriteria</label>
        <input
            type="text"
            name="code"
            id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $criterion->code ?? '') }}"
            placeholder="Contoh: C1"
        >
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="form-label">Nama Kriteria</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $criterion->name ?? '') }}"
            placeholder="Contoh: Biaya Operasional"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="type" class="form-label">Tipe Kriteria</label>
        <select
            name="type"
            id="type"
            class="form-select @error('type') is-invalid @enderror"
        >
            <option value="">-- Pilih Tipe --</option>
            <option value="benefit" {{ old('type', $criterion->type ?? '') == 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('type', $criterion->type ?? '') == 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="weight" class="form-label">Bobot</label>
        <input
            type="number"
            name="weight"
            id="weight"
            class="form-control @error('weight') is-invalid @enderror"
            value="{{ old('weight', $criterion->weight ?? '') }}"
            min="1"
            max="100"
            placeholder="Masukkan bobot 1 - 100"
        >
        @error('weight')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea
            name="description"
            id="description"
            rows="4"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Deskripsi kriteria (opsional)"
        >{{ old('description', $criterion->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>