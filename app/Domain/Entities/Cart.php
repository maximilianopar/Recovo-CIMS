<?php

namespace App\Domain\Entities;

use App\Models\Cart as ModelsCart;

class Cart
{
    const PRINCIPAL_CART = 1;
    private int $id;
    private int $userId;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(int $id, int $userId, string $createdAt, string $updatedAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getPrincipalCart(): ?ModelsCart
    {
        return ModelsCart::with('cartItems.product')->find(self::PRINCIPAL_CART);
    }

}
