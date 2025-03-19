<?php

namespace App\Domain\DTOs;

class CartItemDTO
{
    public function __construct(
        public string $productId,
        public string $quantity,
    ) {}

    public static function fromData(array $data): self
    {
        return new self(
            productId: $data['productId'],
            quantity: $data['quantity'],
        );
    }
}
