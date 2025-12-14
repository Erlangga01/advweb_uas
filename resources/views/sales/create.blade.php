@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h4 class="card-title mb-0 fw-bold text-primary"><i class="fas fa-cart-plus me-2"></i>Input Penjualan
                        Baru</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('sales.store') }}" method="POST" id="salesForm">
                        @csrf

                        @if (session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Tanggal -->
                                <div class="mb-3">
                                    <label class="form-label text-muted small uppercase fw-bold">Tanggal Transaksi</label>
                                    <input type="date" name="transaction_date" class="form-control"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Pelanggan -->
                                <div class="mb-3">
                                    <label class="form-label text-muted small uppercase fw-bold">Nama Pelanggan</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        placeholder="Contoh: Pak Budi" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h5 class="text-secondary mb-3">Item Penjualan</h5>

                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small uppercase fw-bold">Pilih Produk</label>
                                        <select id="productSelect" class="form-select">
                                            <option value="" disabled selected>-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                    data-name="{{ $product->name }}">
                                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-muted small uppercase fw-bold">Qty</label>
                                        <input type="number" id="qtyInput" value="1" min="1" class="form-control">
                                    </div>
                                    <div class="col-md-3 d-grid">
                                        <button type="button" class="btn btn-secondary" id="addItemBtn">
                                            <i class="fas fa-plus me-1"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover align-middle" id="itemsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-end" width="150">Harga (Rp)</th>
                                        <th class="text-center" width="100">Qty</th>
                                        <th class="text-end" width="180">Subtotal (Rp)</th>
                                        <th class="text-center" width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="emptyRow">
                                        <td colspan="5" class="text-center py-3 text-muted">Belum ada item ditambahkan</td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="3" class="text-end">Total Akhir</td>
                                        <td class="text-end" id="finalTotal">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Wadah untuk input tersembunyi -->
                        <div id="hiddenInputs"></div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="fas fa-save me-2"></i> Simpan Transaksi
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="alert alert-info mt-4 d-flex align-items-center">
                <i class="fas fa-lightbulb fa-2x me-3 opacity-50"></i>
                <div>
                    <small>Pastikan stok bahan baku (Kabel, Kayu, dll) mencukupi. Sistem akan menolak transaksi jika stok
                        salah satu bahan tidak mencukupi untuk item yang dipilih.</small>
                </div>
            </div>
        </div>
    </div>

    <script>
        const productSelect = document.getElementById('productSelect');
        const qtyInput = document.getElementById('qtyInput');
        const addItemBtn = document.getElementById('addItemBtn');
        const itemsTableBody = document.querySelector('#itemsTable tbody');
        const emptyRow = document.getElementById('emptyRow');
        const finalTotalDisplay = document.getElementById('finalTotal');
        const hiddenInputsContainer = document.getElementById('hiddenInputs');
        const salesForm = document.getElementById('salesForm');

        let items = [];

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function renderTable() {
            // Hapus baris saat ini kecuali logika emptyRow
            itemsTableBody.innerHTML = '';

            if (items.length === 0) {
                itemsTableBody.appendChild(emptyRow);
                finalTotalDisplay.innerText = '0';
                return;
            }

            let total = 0;

            items.forEach((item, index) => {
                const subtotal = item.price * item.qty;
                total += subtotal;

                const row = document.createElement('tr');
                row.innerHTML = `
                            <td>${item.name}</td>
                            <td class="text-end">${formatRupiah(item.price)}</td>
                            <td class="text-center">${item.qty}</td>
                            <td class="text-end">${formatRupiah(subtotal)}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem(${index})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        `;
                itemsTableBody.appendChild(row);
            });

            finalTotalDisplay.innerText = formatRupiah(total);
        }

        function renderHiddenInputs() {
            hiddenInputsContainer.innerHTML = '';
            items.forEach((item, index) => {
                hiddenInputsContainer.innerHTML += `
                            <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                            <input type="hidden" name="items[${index}][quantity]" value="${item.qty}">
                        `;
            });
        }

        addItemBtn.addEventListener('click', () => {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            if (!selectedOption || !selectedOption.value) {
                alert('Silakan pilih produk terlebih dahulu');
                return;
            }

            const id = selectedOption.value;
            const name = selectedOption.getAttribute('data-name');
            const price = parseFloat(selectedOption.getAttribute('data-price'));
            const qty = parseInt(qtyInput.value);

            if (qty <= 0) {
                alert('Jumlah qty harus lebih dari 0');
                return;
            }

            // Cek jika item sudah ada -> gabungkan
            const existingItemIndex = items.findIndex(i => i.id === id);
            if (existingItemIndex > -1) {
                items[existingItemIndex].qty += qty;
            } else {
                items.push({ id, name, price, qty });
            }

            renderTable();
            // Reset Input
            productSelect.value = "";
            qtyInput.value = 1;
        });

        window.removeItem = function (index) {
            items.splice(index, 1);
            renderTable();
        }

        salesForm.addEventListener('submit', (e) => {
            if (items.length === 0) {
                e.preventDefault();
                alert('Mohon tambahkan minimal satu produk.');
                return;
            }
            renderHiddenInputs();
        });
    </script>
@endsection