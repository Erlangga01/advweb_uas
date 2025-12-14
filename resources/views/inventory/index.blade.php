@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary"><i class="fas fa-warehouse me-2"></i>Inventaris Bahan Baku</h2>
    </div>

    <!-- Peringatan Stok Rendah -->
    @foreach($materials as $material)
        @if($material->stock < 5)
            <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                <i class="fas fa-exclamation-triangle flex-shrink-0 me-2"></i>
                <div>
                    <strong>Stok Menipis!</strong> {{ $material->name }} tersisa {{ $material->stock }} {{ $material->unit }}.
                    Segera restock.
                </div>
            </div>
        @endif
    @endforeach

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nama Bahan</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $material->name }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $material->stock < 5 ? 'bg-danger' : 'bg-success' }} rounded-pill"
                                        style="font-size: 0.9rem;">
                                        {{ $material->stock + 0 }}
                                    </span>
                                </td>
                                <td class="text-center text-muted">{{ $material->unit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data bahan baku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted text-center small">
            Menampilkan {{ count($materials) }} jenis bahan baku
        </div>
    </div>
@endsection