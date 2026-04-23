<div class="row g-3">
    <div class="col-md-6">
        <label for="code" class="form-label">Kode Alternatif</label>
        <input
            type="text"
            name="code"
            id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $alternative->code ?? '') }}"
            placeholder="Contoh: A1"
        >
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="form-label">Nama Alternatif</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $alternative->name ?? '') }}"
            placeholder="Contoh: SEO"
        >
        @error('name')
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
            placeholder="Deskripsi alternatif (opsional)"
        >{{ old('description', $alternative->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>