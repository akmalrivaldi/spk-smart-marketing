<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CriterionController extends Controller
{
    public function index()
    {
        $criteria = Criterion::latest()->get();

        return view('criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:criteria,code'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['benefit', 'cost'])],
            'weight' => ['required', 'integer', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
        ], [
            'code.required' => 'Kode kriteria wajib diisi.',
            'code.unique' => 'Kode kriteria sudah digunakan.',
            'name.required' => 'Nama kriteria wajib diisi.',
            'type.required' => 'Tipe kriteria wajib dipilih.',
            'type.in' => 'Tipe kriteria harus benefit atau cost.',
            'weight.required' => 'Bobot kriteria wajib diisi.',
            'weight.integer' => 'Bobot harus berupa angka bulat.',
            'weight.min' => 'Bobot minimal 1.',
            'weight.max' => 'Bobot maksimal 100.',
        ]);

        Criterion::create($validated);

        return redirect()
            ->route('criteria.index')
            ->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function show(Criterion $criterion)
    {
        return redirect()->route('criteria.index');
    }

    public function edit(Criterion $criterion)
    {
        return view('criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criterion $criterion)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('criteria', 'code')->ignore($criterion->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['benefit', 'cost'])],
            'weight' => ['required', 'integer', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
        ], [
            'code.required' => 'Kode kriteria wajib diisi.',
            'code.unique' => 'Kode kriteria sudah digunakan.',
            'name.required' => 'Nama kriteria wajib diisi.',
            'type.required' => 'Tipe kriteria wajib dipilih.',
            'type.in' => 'Tipe kriteria harus benefit atau cost.',
            'weight.required' => 'Bobot kriteria wajib diisi.',
            'weight.integer' => 'Bobot harus berupa angka bulat.',
            'weight.min' => 'Bobot minimal 1.',
            'weight.max' => 'Bobot maksimal 100.',
        ]);

        $criterion->update($validated);

        return redirect()
            ->route('criteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui.');
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return redirect()
            ->route('criteria.index')
            ->with('success', 'Data kriteria berhasil dihapus.');
    }
}