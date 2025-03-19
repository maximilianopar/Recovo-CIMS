<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Cart;

interface CartRepositoryInterface
{
    public function getCartByUserId(int $userId): ?Cart;
    public function emptyCart(int $userId): void;
}
