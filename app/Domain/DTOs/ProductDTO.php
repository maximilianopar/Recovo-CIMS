<?php

namespace App\Domain\DTOs;

    class ProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public int $stock,
    ){}
   
    public static function fromData(array $data) : self{
        return new self(
            name: $data['name'],
            description: $data['description'],
            price: $data['price'],
            stock: $data['stock'],
        );
    }
}
