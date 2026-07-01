<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Sneakers', 'slug' => 'sneakers'],
            ['name' => 'Running', 'slug' => 'running'],
            ['name' => 'Casual', 'slug' => 'casual'],
            ['name' => 'Formal', 'slug' => 'formal'],
        ];

        foreach ($categories as $catData) {
            Category::firstOrCreate(['slug' => $catData['slug']], $catData);
        }

        $sneakers = Category::where('slug', 'sneakers')->first();
        $running = Category::where('slug', 'running')->first();
        $casual = Category::where('slug', 'casual')->first();

        // Create Dummy Products (Matching the welcome view design)
        $products = [
            [
                'category_id' => $sneakers->id,
                'name' => 'Nike Air Max Pro',
                'slug' => Str::slug('Nike Air Max Pro'),
                'sku' => 'NKE-AMP-001',
                'price' => 1500000,
                'strike_price' => 1800000,
                'description' => 'Sepatu sneakers premium dengan bantalan udara maksimal untuk kenyamanan harian Anda.',
                'stock' => 50,
                'badge' => 'New',
                // Using Unsplash placeholder URL from original design
                'thumbnail' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            ],
            [
                'category_id' => $running->id,
                'name' => 'Puma Velocity Nitro',
                'slug' => Str::slug('Puma Velocity Nitro'),
                'sku' => 'PMA-VLN-002',
                'price' => 1200000,
                'strike_price' => null,
                'description' => 'Sepatu lari ringan dan responsif, dirancang untuk kecepatan maksimal.',
                'stock' => 30,
                'badge' => 'Promo',
                'thumbnail' => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            ],
            [
                'category_id' => $casual->id,
                'name' => 'Vans Old Skool',
                'slug' => Str::slug('Vans Old Skool'),
                'sku' => 'VNS-OS-003',
                'price' => 899000,
                'strike_price' => null,
                'description' => 'Gaya klasik yang tidak pernah lekang oleh waktu. Cocok untuk hangout santai.',
                'stock' => 100,
                'badge' => 'Best Seller',
                'thumbnail' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            ],
            [
                'category_id' => $sneakers->id,
                'name' => 'Nike Air Force 1',
                'slug' => Str::slug('Nike Air Force 1'),
                'sku' => 'NKE-AF1-004',
                'price' => 1649000,
                'strike_price' => null,
                'description' => 'Ikon gaya jalanan dengan sol tebal dan kenyamanan ekstra.',
                'stock' => 20,
                'badge' => null,
                'thumbnail' => 'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            ]
        ];

        foreach ($products as $prodData) {
            Product::firstOrCreate(['slug' => $prodData['slug']], $prodData);
        }
    }
}
