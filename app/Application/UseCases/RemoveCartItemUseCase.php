<?php

namespace App\Application\UseCases;

use App\Application\Services\CartItemService;

class RemoveCartItemUseCase
{
    private CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function execute(int $cartItemId)
    {
        return $this->cartItemService->removeCartItem($cartItemId);
    }
}