<?php

namespace App\Infrastructure\Persistence;

use App\Domain\DTOs\CartItemDTO;
use App\Domain\Entities\Cart as EntitiesCart;
use App\Domain\Entities\CartItem;
use App\Domain\Repositories\CartItemRepositoryInterface;
use App\Exceptions\CartItemNotFoundException;
use App\Models\Cart;
use App\Models\CartItem as ModelsCartItem;
use Exception;

class CartItemRepository implements CartItemRepositoryInterface
{
    /**
     * Agrega un item al carrito de un usuario.
     *
     * @param int $userId El ID del usuario.
     * @param CartItemDTO $cartItemDTO Los datos del item del carrito.
     * @return CartItem El item del carrito agregado.
     */
    public function addItemToCart(CartItemDTO $cartItemDTO): CartItem
    {
        $cartItemModel = ModelsCartItem::create([
            'cart_id' => EntitiesCart::getPrincipalCart()->id,
            'product_id' => $cartItemDTO->productId,
            'quantity' => $cartItemDTO->quantity,
        ]);

        return $this->mapToEntity($cartItemModel);
    }

    /**
     * Actualiza un item en el carrito de un usuario.
     *
     * @param int $userId El ID del usuario.
     * @param int $itemId El ID del item a actualizar.
     * @param CartItemDTO $cartItemDTO Los nuevos datos del item.
     * @return CartItem|null El item del carrito actualizado, o null si no existe.
     */
    public function updateCartItem(int $itemId, CartItemDTO $cartItemDTO): ?CartItem
    {
        $cartItemModel = ModelsCartItem::find($itemId);
        $cartItemModel->update($this->mapToModel($cartItemDTO));
        return $this->mapToEntity($cartItemModel);
    
    }

    /**
     * Elimina un item del carrito de un usuario.
     *
     * @param int $userId El ID del usuario.
     * @param int $itemId El ID del item a eliminar.
     * @return void
     */
    public function removeItemFromCart(int $itemId): void
    {
        $cartItemModel = ModelsCartItem::find($itemId);
        $cartItemModel->delete();
    }

    /**
     * Mapea un modelo de CartItem a una entidad de dominio CartItem.
     *
     * @param ModelsCartItem $cartItemModel El modelo del item del carrito.
     * @return CartItem La entidad de dominio CartItem.
     */
    private function mapToEntity(ModelsCartItem $cartItemModel): CartItem
    {
        return new CartItem(
            $cartItemModel->id,
            $cartItemModel->cart_id,
            $cartItemModel->product_id,
            $cartItemModel->quantity,
            $cartItemModel->created_at,
            $cartItemModel->updated_at
        );
    }

    /**
     * Mapea un CartItemDTO a un array compatible con el modelo CartItem.
     *
     * @param CartItemDTO $cartItemDTO El DTO que contiene los datos del item.
     * @return array El array con los datos que serán utilizados para actualizar el modelo CartItem.
     */
    private function mapToModel(CartItemDTO $cartItemDTO): array
    {
        return [
            'product_id' => $cartItemDTO->productId,
            'quantity' => (int)$cartItemDTO->quantity,
            'updated_at' => now(),
        ];
    }
}
