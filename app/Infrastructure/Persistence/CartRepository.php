<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Cart;
use App\Domain\Repositories\CartRepositoryInterface;
use App\Models\Cart as CartModel;
use Exception;

class CartRepository implements CartRepositoryInterface
{
    /**
     * Obtiene el carrito de un usuario por su ID.
     *
     * @param int $userId El ID del usuario.
     * @return Cart|null El carrito del usuario o null si no existe.
     */
    public function getCartByUserId(int $userId): ?Cart
    {
        $cartModel = CartModel::with('cartItems.product')->where('user_id', $userId)->first();
    
        return $cartModel ? $this->mapToEntity($cartModel) : null;
    }

    /**
     * Vacía el carrito de un usuario.
     *
     * @param int $userId El ID del usuario.
     * @return void
     */
    public function emptyCart(int $userId): void
    {
        $cartModel = CartModel::where('user_id', $userId)->first();

        if (!$cartModel) {
            throw new \Exception("Cart not found for user with ID: {$userId}", 404);
        }

        $cartModel->cartItems()->delete();
    }   

    /**
     * Mapea un modelo de carrito a una entidad de dominio.
     *
     * @param CartModel $cartModel El modelo de carrito.
     * @return Cart La entidad de dominio Cart.
     */
    private function mapToEntity(CartModel $cartModel): Cart
    {
        return new Cart(
            $cartModel->id,
            $cartModel->user_id,
            $cartModel->created_at,
            $cartModel->updated_at
        );
    }
}
