@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9"> <!-- Slightly wider for better table display -->
            <div class="card shadow-sm">
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
                                    <div class="col-md-5">
                                        <label class="form-label text-muted small uppercase fw-bold">Pilih Produk</label>
                                        <select id="productSelect" class="form-select">
                                            <option value="" disabled selected>-- Pilih Produk --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                    data-name="{{ $product->name }}">
                                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label text-muted small uppercase fw-bold">Qty</label>
                                        <input type="number" id="qtyInput" value="1" min="1"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-2 d-grid">
                                        <label class="form-label text-muted small uppercase fw-bold">&nbsp;</label>
                                        <button type="button" class="btn btn-secondary" id="addItemBtn">
                                            <i class="fas fa-plus me-1"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover align-middle bg-white" id="itemsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-end" width="130">Harga (Rp)</th>
                                        <th class="text-center" width="80">Qty</th>
                                        <th class="text-center" width="80">Satuan</th>
                                        <th class="text-center" width="80">Disc (%)</th>
                                        <th class="text-end" width="150">Subtotal (Rp)</th>
                                        <th class="text-center" width="100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="emptyRow">
                                        <td colspan="7" class="text-center py-3 text-muted">Belum ada item ditambahkan
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="5" class="text-end">Total Sementara</td>
                                        <td class="text-end" id="subTotalDisplay">0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end text-muted align-middle">VAT / PPN (%)</td>
                                        <td class="text-end">
                                            <input type="number" id="globalVat" class="form-control form-control-sm text-end"
                                                value="0" min="0" max="100" step="1">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr class="fs-5">
                                        <td colspan="5" class="text-end">Grand Total</td>
                                        <td class="text-end text-primary" id="finalTotal">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Wadah untuk input tersembunyi -->
                        <div id="hiddenInputs"></div>
                        <input type="hidden" name="grand_totalnya" id="inputGrandTotal">

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
                    <small>Klik tombol <strong><i class="fas fa-pencil-alt"></i></strong> untuk mengubah nama item, harga,
                        satuan, atau diskon. Pastikan stok bahan baku mencukupi.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Item -->
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIndex">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="editName">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="editPrice">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editQty" min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="editSatuan" placeholder="Contoh: Unit, Pcs">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <input type="number" class="form-control" id="editDiscount" min="0" max="100"
                                value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('productSelect');
            const qtyInput = document.getElementById('qtyInput');
            const addItemBtn = document.getElementById('addItemBtn');
            const itemsTableBody = document.querySelector('#itemsTable tbody');
            const emptyRow = document.getElementById('emptyRow');
            const subTotalDisplay = document.getElementById('subTotalDisplay');
            const finalTotalDisplay = document.getElementById('finalTotal');
            const globalVatInput = document.getElementById('globalVat');
            const hiddenInputsContainer = document.getElementById('hiddenInputs');
            const inputGrandTotal = document.getElementById('inputGrandTotal');
            const salesForm = document.getElementById('salesForm');

            // Modal Elements
            const editItemModalEl = document.getElementById('editItemModal');
            let editItemModal;
            if (window.bootstrap) {
                editItemModal = new bootstrap.Modal(editItemModalEl);
            } else {
                console.error('Bootstrap driver not found');
            }

            const saveEditBtn = document.getElementById('saveEditBtn');
            const editIndexInput = document.getElementById('editIndex');
            const editNameInput = document.getElementById('editName');
            const editPriceInput = document.getElementById('editPrice');
            const editQtyInput = document.getElementById('editQty');
            const editSatuanInput = document.getElementById('editSatuan');
            const editDiscountInput = document.getElementById('editDiscount');

            let items = [];

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            function calculateSubtotal(item) {
                const initialTotal = item.price * item.qty;
                const discountAmount = initialTotal * (item.discount / 100);
                return initialTotal - discountAmount;
            }

            function renderTable() {
                itemsTableBody.innerHTML = '';

                if (items.length === 0) {
                    itemsTableBody.appendChild(emptyRow);
                    subTotalDisplay.innerText = '0';
                    finalTotalDisplay.innerText = '0';
                    inputGrandTotal.value = 0;
                    return;
                }

                let totalBeforeTax = 0;

                items.forEach((item, index) => {
                    const subtotal = calculateSubtotal(item);
                    totalBeforeTax += subtotal;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td>${item.name}</td>
                            <td class="text-end">${formatRupiah(item.price)}</td>
                            <td class="text-center">${item.qty}</td>
                            <td class="text-center">${item.satuan}</td>
                            <td class="text-center">${item.discount}%</td>
                            <td class="text-end">${formatRupiah(subtotal)}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-warning" onclick="openEditModal(${index})">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" onclick="removeItem(${index})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                    itemsTableBody.appendChild(row);
                });

                // Hitung VAT
                const vatPercentage = parseFloat(globalVatInput.value) || 0;
                const vatAmount = totalBeforeTax * (vatPercentage / 100);
                const grandTotal = totalBeforeTax + vatAmount;

                subTotalDisplay.innerText = formatRupiah(totalBeforeTax);
                finalTotalDisplay.innerText = formatRupiah(grandTotal);
                inputGrandTotal.value = grandTotal;
            }

            function renderHiddenInputs() {
                hiddenInputsContainer.innerHTML = '';
                items.forEach((item, index) => {
                    const total_price = calculateSubtotal(item); // Ini adalah subtotal per item setelah diskon

                    hiddenInputsContainer.innerHTML += `
                            <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                            <input type="hidden" name="items[${index}][name]" value="${item.name}">
                            <input type="hidden" name="items[${index}][price]" value="${item.price}">
                            <input type="hidden" name="items[${index}][quantity]" value="${item.qty}">
                            <input type="hidden" name="items[${index}][satuan]" value="${item.satuan}">
                            <input type="hidden" name="items[${index}][discount]" value="${item.discount}">
                            <input type="hidden" name="items[${index}][total_price]" value="${total_price}">
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
                const originalName = selectedOption.getAttribute('data-name');
                const price = parseFloat(selectedOption.getAttribute('data-price'));
                const qty = parseInt(qtyInput.value);

                if (qty <= 0) {
                    alert('Jumlah qty harus lebih dari 0');
                    return;
                }

                // Default values
                const newItem = {
                    id,
                    name: originalName,
                    price: price,
                    qty: qty,
                    satuan: 'unit',
                    discount: 0
                };

                items.push(newItem);
                renderTable();

                // Reset Input
                productSelect.value = "";
                qtyInput.value = 1;
            });

            window.removeItem = function(index) {
                items.splice(index, 1);
                renderTable();
            }

            window.openEditModal = function(index) {
                const item = items[index];
                editIndexInput.value = index;
                editNameInput.value = item.name;
                editPriceInput.value = item.price;
                editQtyInput.value = item.qty;
                editSatuanInput.value = item.satuan;
                editDiscountInput.value = item.discount;
                if (editItemModal) editItemModal.show();
            }

            saveEditBtn.addEventListener('click', () => {
                const index = parseInt(editIndexInput.value);
                if (index >= 0 && index < items.length) {
                    items[index].name = editNameInput.value;
                    items[index].price = parseFloat(editPriceInput.value) || 0;
                    items[index].qty = parseInt(editQtyInput.value) || 1;
                    items[index].satuan = editSatuanInput.value;
                    items[index].discount = parseFloat(editDiscountInput.value) || 0;

                    renderTable();
                    if (editItemModal) editItemModal.hide();
                }
            });

            globalVatInput.addEventListener('input', renderTable);

            salesForm.addEventListener('submit', (e) => {
                if (items.length === 0) {
                    e.preventDefault();
                    alert('Mohon tambahkan minimal satu produk.');
                    return;
                }
                renderHiddenInputs();
            });
        });
    </script>
@endsection