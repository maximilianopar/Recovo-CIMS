<?php
namespace App\Application\UseCases;

use App\Application\Services\CartService;
use App\Domain\DTOs\CartDetailsDTO;

class GetCartDetailsUseCase
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function execute(CartDetailsDTo $cartDetailsDTO)
    {
        return $this->cartService->getCartDetails($cartDetailsDTO->userId);
    }
}
