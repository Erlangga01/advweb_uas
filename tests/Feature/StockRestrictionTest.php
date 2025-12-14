<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Material;
use App\Models\User;

class StockRestrictionTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_fails_if_stock_insufficient()
    {
        // Setup
        $material = Material::create(['name' => 'Wood', 'unit' => 'kg', 'stock' => 10]);
        $product = Product::create(['name' => 'Table', 'price' => 100000]);
        $product->materials()->attach($material->id, ['quantity_needed' => 5]);

        // Attempt to buy 3 tables (needs 15kg wood, but only 10kg available)
        $response = $this->post(route('sales.store'), [
            'customer_name' => 'Test Customer',
            'transaction_date' => now()->toDateString(),
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        // Assert
        $response->assertSessionHas('error');
        $this->assertEquals(10, $material->fresh()->stock); // Stock should not change
        $this->assertDatabaseCount('transactions', 0);
    }

    public function test_transaction_succeeds_if_stock_sufficient()
    {
        // Setup
        $material = Material::create(['name' => 'Wood', 'unit' => 'kg', 'stock' => 20]);
        $product = Product::create(['name' => 'Table', 'price' => 100000]);
        $product->materials()->attach($material->id, ['quantity_needed' => 5]);

        // Attempt to buy 3 tables (needs 15kg wood, 20kg available)
        $response = $this->post(route('sales.store'), [
            'customer_name' => 'Test Customer',
            'transaction_date' => now()->toDateString(),
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        // Assert
        $response->assertRedirect(route('sales.index'));
        $response->assertSessionHas('success');
        $this->assertEquals(5, $material->fresh()->stock); // Stock should remain 5 (20 - 15)
        $this->assertDatabaseCount('transactions', 1);
    }
}
