<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'EcoTex Recycled Fabric',
                'description' => 'High-quality recycled fabric, ideal for creating new garments in sustainable fashion.',
                'price' => 50
            ],
            [
                'name' => 'ReFashion Recycled T-shirt',
                'description' => 'T-shirt made from recycled materials, designed to offer comfort and style while promoting sustainability.',
                'price' => 25
            ],
            [
                'name' => 'Vintage Recycled Fabric',
                'description' => 'Vintage fabric recovered from past collections, ready to be reused in new creations.',
                'price' => 75
            ],
            [
                'name' => 'UpCycle Textile Accessory',
                'description' => 'Accessories made from recycled materials, perfect for adding a unique touch to any garment.',
                'price' => 15
            ],
            [
                'name' => 'GreenStep Sustainable Footwear',
                'description' => 'Footwear made with recycled and reused materials, offering comfort and contributing to circularity.',
                'price' => 120
            ],
            [
                'name' => 'EcoThread Recycled Thread',
                'description' => 'High-strength thread made from recycled materials, ideal for sewing and sustainable repairs.',
                'price' => 10
            ],
            [
                'name' => 'RecycledTech Jacket',
                'description' => 'Jacket made with recycled fabrics, designed for durability and environmental protection.',
                'price' => 150
            ],
            [
                'name' => 'UpCycle Pillowcase',
                'description' => 'Pillowcase made with recycled textile materials, soft and eco-friendly.',
                'price' => 20
            ],
            [
                'name' => 'EcoPack Sustainable Backpack',
                'description' => 'Backpack made from recycled materials, perfect for those seeking an eco-friendly option for daily use.',
                'price' => 45
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
