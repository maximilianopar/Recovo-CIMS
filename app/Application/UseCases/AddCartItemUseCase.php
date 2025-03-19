<?php

namespace App\Application\UseCases;

use App\Application\Services\CartItemService;
use App\Domain\DTOs\CartItemDTO;

class AddCartItemUseCase
{
    private CartItemService $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function execute(CartItemDTO $cartItemDTO)
    { 
        return $this->cartItemService->addItemToCart($cartItemDTO);
    }
}