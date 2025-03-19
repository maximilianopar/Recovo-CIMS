<?php

namespace App\Application\UseCases;

use App\Domain\DTOs\CartItemDTO;
use App\Application\Services\CartItemService;

class UpdateCartItemUseCase
{
    private CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function execute(int $cartItemId, CartItemDTO $cartItemDTO)
    {
        return $this->cartItemService->updateCartItem($cartItemId, $cartItemDTO);
    }
}