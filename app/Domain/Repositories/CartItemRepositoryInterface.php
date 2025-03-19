<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\CartItemDTO;
use App\Domain\Entities\CartItem;

interface CartItemRepositoryInterface
{
    public function addItemToCart(CartItemDTO $cartItemDTO): CartItem;
    public function updateCartItem(int $itemId, CartItemDTO $cartItemDTO): ?CartItem;
    public function removeItemFromCart(int $itemId): void;
}
