<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Material;
use App\Models\Transaction;
use App\Models\TransactionDetail;


class AxlController extends Controller
{
    // 1. GET: Ambil semua produk untuk Dropdown
    public function getProducts()
    {
        return response()->json(Product::all());
    }

    // 2. GET: Ambil data inventaris (Bahan Baku)
    public function getMaterials()
    {
        return response()->json(Material::all());
    }

    // 3. GET: Ambil riwayat transaksi
    public function getTransactions()
    {
        // Mengambil transaksi beserta detail produknya
        $transactions = Transaction::with('details.product')
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions);
    }

    // 4. POST: Simpan Transaksi Baru
    public function storeTransaction(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validasi input dari Flutter
            $request->validate([
                'customer_name' => 'required|string',
                'transaction_date' => 'required|date',
                'items' => 'required|array', // Array dari {product_id, quantity}
            ]);

            $totalAmount = 0;

            // Buat Header Transaksi
            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'transaction_date' => $request->transaction_date,
                'total_amount' => 0 // Akan diupdate nanti
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $qty = $item['quantity'];
                $subtotal = $product->price * $qty;
                $totalAmount += $subtotal;

                // Simpan Detail Transaksi
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ]);

                // --- LOGIKA PENGURANGAN STOK (BAHAN BAKU) ---
                // Ambil resep bahan baku produk ini
                // Menggunakan relationship 'materials' yang ada di model Product
                foreach ($product->materials as $material) {
                    // Kurangi stok bahan: (butuh per unit * qty produk yang dibeli)
                    $qtyNeededPerUnit = $material->pivot->quantity_needed;
                    $totalMaterialNeeded = $qtyNeededPerUnit * $qty;

                    if ($material->stock < $totalMaterialNeeded) {
                        throw new \Exception("Stok bahan {$material->name} tidak cukup!");
                    }

                    $material->decrement('stock', $totalMaterialNeeded);
                }
            }

            // Update Total Harga Transaksi
            $transaction->update(['total_amount' => $totalAmount]);

            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil disimpan', 'data' => $transaction], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()], 500);
        }
    }
}