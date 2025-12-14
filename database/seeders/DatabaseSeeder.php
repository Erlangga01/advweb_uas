<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed database aplikasi.
     */
    public function run(): void
    {
        // 1. Buat Bahan Baku
        $materials = [
            ['name' => 'Triplek Meranti 18mm', 'unit' => 'Lembar', 'stock' => 50],
            ['name' => 'Speaker RCF 18 inch Low', 'unit' => 'Pcs', 'stock' => 20],
            ['name' => 'Speaker ACR 15 inch Mid', 'unit' => 'Pcs', 'stock' => 30],
            ['name' => 'Tweeter Compression Driver', 'unit' => 'Pcs', 'stock' => 40],
            ['name' => 'Kabel Audio Canare', 'unit' => 'Meter', 'stock' => 500],
            ['name' => 'Jack Spikon Biru', 'unit' => 'Pcs', 'stock' => 100],
            ['name' => 'Lem Kayu Fox', 'unit' => 'Kaleng', 'stock' => 25],
            ['name' => 'Cat Tekstur Hitam', 'unit' => 'Kaleng', 'stock' => 15],
            ['name' => 'Grill Besi Penutup', 'unit' => 'Lembar', 'stock' => 30],
            ['name' => 'Handle Besi Box', 'unit' => 'Pcs', 'stock' => 80],
        ];

        foreach ($materials as $m) {
            \App\Models\Material::create($m);
        }

        // 2. Buat Produk (Barang Jadi)
        $sub18 = \App\Models\Product::create([
            'name' => 'Box Subwoofer 18" Lapangan (Finished)',
            'price' => 3500000
        ]);

        $mid15 = \App\Models\Product::create([
            'name' => 'Speaker 15" Aktif Rakitan',
            'price' => 4500000
        ]);

        $kabelSet = \App\Models\Product::create([
            'name' => 'Kabel Speaker Set 20 Meter',
            'price' => 450000
        ]);

        // 3. Definisikan Resep (Bahan Produk)

        // Resep untuk Subwoofer 18"
        // Membutuhkan: 1 Speaker, 0.5 Triplek, 0.2 Cat, 0.1 Lem, 1 Grill, 2 Handles, 1 Jack (Socket)
        $sub18->materials()->attach([
            \App\Models\Material::where('name', 'Speaker RCF 18 inch Low')->first()->id => ['quantity_needed' => 1],
            \App\Models\Material::where('name', 'Triplek Meranti 18mm')->first()->id => ['quantity_needed' => 0.5], // Setengah lembar per box
            \App\Models\Material::where('name', 'Cat Tekstur Hitam')->first()->id => ['quantity_needed' => 0.2],
            \App\Models\Material::where('name', 'Lem Kayu Fox')->first()->id => ['quantity_needed' => 0.1],
            \App\Models\Material::where('name', 'Grill Besi Penutup')->first()->id => ['quantity_needed' => 0.15], // Potongan
            \App\Models\Material::where('name', 'Handle Besi Box')->first()->id => ['quantity_needed' => 2],
        ]);

        // Resep untuk Kabel Set 20m
        // Membutuhkan: 20m Kabel, 2 Jack Spikon
        $kabelSet->materials()->attach([
            \App\Models\Material::where('name', 'Kabel Audio Canare')->first()->id => ['quantity_needed' => 20],
            \App\Models\Material::where('name', 'Jack Spikon Biru')->first()->id => ['quantity_needed' => 2],
        ]);
    }
}
