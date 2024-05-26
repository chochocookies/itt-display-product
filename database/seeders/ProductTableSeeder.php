<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/product.json');
        $products = json_decode($json, true);

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'title' => $product['title'],
                'rak' => $product['rak'],
                'shelf' => $product['shelf'],
                'baris' => $product['baris'],
                'price' => $product['price'],
                'description' => $product['description'],
                'product_code' => $product['product_code'],

            ]);
        }
    }
}
