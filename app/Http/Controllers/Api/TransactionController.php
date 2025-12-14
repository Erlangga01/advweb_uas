<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'transaction_date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalTransaction = 0;
            $detailsData = [];
            $productsCache = [];

            // Hitung total terlebih dahulu
            foreach ($request->items as $item) {
                $product = Product::with('materials')->findOrFail($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $totalTransaction += $subtotal;

                $detailsData[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
            }

            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'transaction_date' => $request->transaction_date,
                'total_amount' => $totalTransaction
            ]);

            foreach ($detailsData as $data) {
                // Buat Detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $data['product']->id,
                    'quantity' => $data['quantity'],
                    'price' => $data['product']->price,
                    'subtotal' => $data['subtotal']
                ]);

                // Kurangi Stok
                foreach ($data['product']->materials as $material) {
                    $needed = $material->pivot->quantity_needed * $data['quantity'];
                    $material->decrement('stock', $needed);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Transaksi berhasil',
                'data' => $transaction
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
