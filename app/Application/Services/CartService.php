<?php

namespace App\Application\Services;

use App\Domain\Entities\Cart;
use App\Domain\Entities\CartItem;
use App\Infrastructure\Persistence\CartRepository;

class CartService
{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Obtiene el contenido del carrito de un usuario.
     *
     * @param int $userId ID del usuario
     * @return mixed|null Retorna el carrito si existe, de lo contrario null.
     */
    public function getCartContents(int $userId): ?Cart 
    {
        return $this->cartRepository->getCartByUserId($userId);
    }

    /**
     * Vacía el carrito de un usuario, eliminando todos sus items.
     *
     * @param int $userId ID del usuario
     * @return void
     */
    public function emptyCart(int $userId): void
    {
        $this->cartRepository->emptyCart($userId);
    }

    /**
     * Obtiene los detalles del carrito de un usuario
     *
     * @param int $userId ID del usuario propietario del carrito.
     * @return array|null Retorna un array con los detalles de los productos en el carrito
     */
    public function getCartDetails() : array
    {
        $cart = Cart::getPrincipalCart();

        $cartItemsDetails = $cart->cartItems->map(function ($cartItem) {
            return [
                'id' => $cartItem->id, 
                'cart_id' => $cartItem->cart_id, 
                'product_id' => $cartItem->product_id, 
                'quantity' => $cartItem->quantity, 
                'product_details' => [
                    'name' => $cartItem->product->name, 
                    'price' => $cartItem->product->price, 
                    'stock' => $cartItem->product->stock 
                ],
                'created_at' => $cartItem->created_at, 
                'updated_at' => $cartItem->updated_at,
            ];
        })->toarray();

        return $cartItemsDetails;
    }
}
