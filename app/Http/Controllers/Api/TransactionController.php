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
            'grand_totalnya' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.satuan' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.total_price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'transaction_date' => $request->transaction_date,
                'total_amount' => $request->grand_totalnya
            ]);

            foreach ($request->items as $item) {
                // Buat Detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'satuan' => $item['satuan'],
                    'price' => $item['price'],
                    'subtotal' => $item['total_price']
                ]);

                // Update Stok (Tetap dilakukan untuk konsistensi data, meski harga dari client)
                $product = Product::with('materials')->find($item['product_id']);
                if ($product) {
                    foreach ($product->materials as $material) {
                        $needed = $material->pivot->quantity_needed * $item['quantity'];
                        $material->decrement('stock', $needed);
                    }
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
