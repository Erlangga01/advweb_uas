<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->with('details.product')->get();
        return response()->json($transactions);
    }

    public function create()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'transaction_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.name' => 'nullable|string',
            'items.*.price' => 'nullable|numeric|min:0',
            'items.*.total_price' => 'nullable|numeric|min:0',
            'items.*.satuan' => 'nullable|string',
        ]);

        $totalAmount = 0;
        $transactionItems = [];

        // Ambil semua produk terlebih dahulu untuk menghindari N+1 dan cek stok
        // Kami mengelompokkan berdasarkan product_id untuk menjumlahkan kuantitas jika produk yang sama dipilih beberapa kali
        $requestedProducts = [];
        foreach ($request->items as $item) {
            $pid = $item['product_id'];
            $qty = $item['quantity'];
            if (!isset($requestedProducts[$pid])) {
                $requestedProducts[$pid] = 0;
            }
            $requestedProducts[$pid] += $qty;
        }

        foreach ($requestedProducts as $productId => $totalQty) {
            $product = Product::with('materials')->find($productId);

            // Cek ketersediaan stok
            foreach ($product->materials as $material) {
                // Jika beberapa produk menggunakan bahan yang sama, pemeriksaan ini mungkin perlu digabungkan di semua produk.
                // Untuk kesederhanaan, asumsikan penggunaan bahan langsung per produk. 
                // Idealnya, kita harus menggabungkan penggunaan bahan di SEMUA produk yang diminta terlebih dahulu.
                // Mari kita lakukan pemeriksaan yang lebih kuat.
            }
        }

        // Pengecekan Stok yang Kuat
        // 1. Hitung total bahan yang dibutuhkan untuk SEMUA item
        $materialNeeds = [];
        foreach ($requestedProducts as $productId => $totalQty) {
            $product = Product::with('materials')->find($productId);
            foreach ($product->materials as $material) {
                if (!isset($materialNeeds[$material->id])) {
                    $materialNeeds[$material->id] = 0;
                }
                $materialNeeds[$material->id] += $material->pivot->quantity_needed * $totalQty;
            }
        }

        // 2. Verifikasi terhadap stok
        foreach ($materialNeeds as $materialId => $needed) {
            $material = \App\Models\Material::find($materialId);
            if ($material->stock < $needed) {
                return response()->json(['message' => "Stok bahan {$material->name} tidak mencukupi. Total Dibutuhkan: {$needed}, Tersedia: {$material->stock}"], 400);
            }
        }

        $transaction = DB::transaction(function () use ($request, $requestedProducts, &$totalAmount) {
            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'transaction_date' => $request->transaction_date,
                'total_amount' => 0 // Akan diperbarui nanti
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                $qty = $item['quantity'];

                // Use provided price/total_price or fallback to product defaults
                $price = $item['price'] ?? $product->price;
                $subtotal = $item['total_price'] ?? ($price * $qty);
                $name = $item['name'] ?? $product->name;
                $satuan = $item['satuan'] ?? null;

                $totalAmount += $subtotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $subtotal,
                    'name' => $name,
                    'satuan' => $satuan
                ]);

                // Kurangi stok
                foreach ($product->materials as $material) {
                    $needed = $material->pivot->quantity_needed * $qty;
                    $material->decrement('stock', $needed);
                }
            }

            $transaction->update(['total_amount' => $totalAmount]);
            return $transaction;
        });

        return response()->json(['message' => 'Transaksi berhasil disimpan', 'data' => $transaction], 201);
    }
    // public function destroy($id)
    // {
    //     DB::transaction(function () use ($id) {
    //         $transaction = Transaction::with('details.product.materials')->findOrFail($id);

    //         // Restore Stock
    //         foreach ($transaction->details as $detail) {
    //             // If the product still exists, restore stock based on its materials
    //             if ($detail->product) {
    //                 foreach ($detail->product->materials as $material) {
    //                     $restoreAmount = $material->pivot->quantity_needed * $detail->quantity;
    //                     $material->increment('stock', $restoreAmount);
    //                 }
    //             }
    //         }

    //         $transaction->delete();
    //     });

    //     return back()->with('success', 'Transaksi berhasil dihapus dan stok telah dikembalikan.');
    //
}
