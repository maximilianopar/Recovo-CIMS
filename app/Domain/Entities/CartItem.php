<?php

namespace App\Domain\Entities;

class CartItem
{
    private int $id;
    private int $cartId;
    private int $productId;
    private int $quantity;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(int $id, int $cartId, int $productId, int $quantity, string $createdAt, string $updatedAt)
    {
        $this->id = $id;
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
