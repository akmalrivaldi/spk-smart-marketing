<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::latest()->get();

        return view('alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:alternatives,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'code.required' => 'Kode alternatif wajib diisi.',
            'code.unique' => 'Kode alternatif sudah digunakan.',
            'name.required' => 'Nama alternatif wajib diisi.',
        ]);

        Alternative::create($validated);

        return redirect()
            ->route('alternatives.index')
            ->with('success', 'Data alternatif berhasil ditambahkan.');
    }

    public function show(Alternative $alternative)
    {
        return redirect()->route('alternatives.index');
    }

    public function edit(Alternative $alternative)
    {
        return view('alternatives.edit', compact('alternative'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('alternatives', 'code')->ignore($alternative->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'code.required' => 'Kode alternatif wajib diisi.',
            'code.unique' => 'Kode alternatif sudah digunakan.',
            'name.required' => 'Nama alternatif wajib diisi.',
        ]);

        $alternative->update($validated);

        return redirect()
            ->route('alternatives.index')
            ->with('success', 'Data alternatif berhasil diperbarui.');
    }

    public function destroy(Alternative $alternative)
    {
        $alternative->delete();

        return redirect()
            ->route('alternatives.index')
            ->with('success', 'Data alternatif berhasil dihapus.');
    }
}