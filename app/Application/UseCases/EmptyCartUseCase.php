<?php

namespace App\Application\UseCases;

use App\Application\Services\CartService;

class EmptyCartUseCase
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function execute(int $userId)
    {
        return $this->cartService->emptyCart($userId);
    }
}
