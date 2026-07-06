@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="main-title h3 mb-0">Manajemen Pengguna</h1>
        <p class="subtitle mb-0">Kelola akun admin dan user sistem</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
        + Tambah User
    </a>
</div>

<div class="card card-clean">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3 text-center">Role</th>
                        <th class="py-3 text-end px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-3 fw-bold">{{ $user->name }}</td>
                            <td class="py-3">{{ $user->email }}</td>
                            <td class="py-3 text-center">
                                @if($user->isAdmin())
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">Admin</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">User</span>
                                @endif
                            </td>
                            <td class="py-3 text-end px-4">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
