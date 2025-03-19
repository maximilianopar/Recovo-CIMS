<?php

namespace App\Application\Services;

use App\Domain\DTOs\CartItemDTO;
use App\Domain\Entities\CartItem;
use App\Domain\Repositories\CartItemRepositoryInterface;

class CartItemService
{
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    /**
     * Agrega un item al carrito de un usuario.
     *
     * @param int $userId ID del usuario
     * @param CartItemDTO $cartItemDTO Datos del item a agregar.
     * @return CartItem El item del carrito agregado.
     */
    public function addItemToCart(CartItemDTO $cartItemDTO): CartItem
    {
        return $this->cartItemRepository->addItemToCart($cartItemDTO);
    }

    /**
     * Actualiza un item existente en el carrito de un usuario.
     *
     * @param int $userId ID del usuario
     * @param int $itemId ID del item del carrito a actualizar.
     * @param CartItemDTO $cartItemDTO Datos actualizados del item.
     * @return CartItem|null El item actualizado
     */
    public function updateCartItem(int $itemId, CartItemDTO $cartItemDTO): ?CartItem
    {
        return $this->cartItemRepository->updateCartItem($itemId, $cartItemDTO);
    }

    /**
     * Elimina un item del carrito de un usuario.
     *
     * @param int $userId ID del usuario que posee el carrito.
     * @param int $itemId ID del item a eliminar.
     * @return void
     */
    public function removeCartItem(int $itemId): void
    {
        $this->cartItemRepository->removeItemFromCart($itemId);
    }
}
