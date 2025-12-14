@extends('layouts.app')

@section('content')

    <!-- Kartu Ringkasan -->
    <div class="card bg-primary text-white mb-4 shadow overflow-hidden position-relative border-0">
        <div class="position-absolute top-0 end-0 opacity-25" style="transform: translate(20px, -20px); font-size: 8rem;">
            <i class="fas fa-chart-line text-white"></i>
        </div>
        <div class="card-body p-4 position-relative">
            <h6 class="text-uppercase text-white-50 letter-spacing-2">Total Omzet</h6>
            <h1 class="display-5 fw-bold mb-3">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</h1>

            <div class="d-flex gap-4">
                <div>
                    <span class="d-block text-white-50 small">Transaksi</span>
                    <span class="fs-5 fw-bold">{{ $transactions->count() }}x</span>
                </div>
                <div>
                    <span class="d-block text-white-50 small">Terakhir Update</span>
                    <span class="fs-5 fw-bold" id="liveClock"></span> WIB

                    <script>
                        function updateClock() {
                            const now = new Date();
                            let hours = now.getHours().toString().padStart(2, '0');
                            let minutes = now.getMinutes().toString().padStart(2, '0');
                            let seconds = now.getSeconds().toString().padStart(2, '0');

                            document.getElementById('liveClock').textContent = `${hours}:${minutes}:${seconds}`;
                        }
                        updateClock();
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-secondary"><i class="fas fa-history me-2"></i>Riwayat Penjualan</h4>
    </div>

    <div class="row">
        @forelse($transactions as $transaction)
                <div class="col-md-6 mb-3">
                    <div class="card h-100 border-start border-4 border-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="card-subtitle mb-2 text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                        &nbsp;&bull;&nbsp;
                                        <i class="far fa-user me-1"></i> {{ $transaction->customer_name }}
                                    </h6>

                                    <div class="bg-light rounded p-2 mb-2">
                                        <ul class="list-unstyled mb-0 small">
                                            @foreach($transaction->details as $detail)
                                                <li
                                                    class="d-flex justify-content-between border-bottom border-white pb-1 mb-1 last-border-0">
                                                    <span>
                                                        {{ $detail->product->name }}
                                                        <span class="fw-bold text-secondary">x{{ $detail->quantity }}</span>
                                                    </span>
                                                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="badge bg-success-subtle text-success border border-success-subtle mb-2">LUNAS</span>
                                <!-- <form action="{{ route('sales.destroy', $transaction->id) }}" method="POST"
                                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini? Stok akan dikembalikan.');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </form> -->
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">Total Bayar</span>
                            <span class="fw-bold fs-5 text-dark">Rp
                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="col-12">
            <div class="card text-center py-5 border-dashed">
                <div class="card-body">
                    <i class="fas fa-shopping-basket fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data penjualan</h5>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-2">Input Penjualan Baru</a>
                </div>
            </div>
        </div>
    @endforelse
    </div>
@endsection