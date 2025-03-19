<?php

namespace App\Infrastructure\Controllers;

use App\Application\UseCases\AddCartItemUseCase;
use App\Application\UseCases\EmptyCartUseCase;
use App\Application\UseCases\UpdateCartItemUseCase;
use App\Application\UseCases\RemoveCartItemUseCase;
use App\Application\UseCases\GetCartDetailsUseCase;
use App\Domain\DTOs\CartItemDTO;
use App\Domain\DTOs\CartDetailsDTO;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct(
        private AddCartItemUseCase $AddCartItemUseCase,
        private UpdateCartItemUseCase $updateCartItemUseCase,
        private RemoveCartItemUseCase $removeCartItemUseCase,
        private EmptyCartUseCase $emptyCartUseCase,
        private GetCartDetailsUseCase $getCartDetailsUseCase
    ) {}

    public function index(): JsonResponse
    {
        $cartDetailsDTO = new CartDetailsDTO(auth()->id());
        $cartItemsDetails = $this->getCartDetailsUseCase->execute($cartDetailsDTO);

        return response()->json([
            'message' => 'Cart details',
            'cart_items' => $cartItemsDetails,
        ], 200);
    }
    
    public function addItem(AddToCartRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $cartItemDTO = new CartItemDTO(
            $validatedData['product_id'],
            $validatedData['quantity']
        );
       
        $this->AddCartItemUseCase->execute($cartItemDTO);

        return response()->json([
            'message' => 'Item added to cart successfully',
        ], 201);
    }

    public function updateItem(UpdateCartItemRequest $request, int $cartItemId): JsonResponse
    {
        $validatedData = $request->validated();

        $cartItemDTO = new CartItemDTO(
            $validatedData['product_id'],
            $validatedData['quantity']
        );
        $this->updateCartItemUseCase->execute($cartItemId, $cartItemDTO);
    
        return response()->json([
            'message' => 'Your cart item has been successfully updated.',
        ], 201);
    }

    public function removeItem(int $cartItemId): JsonResponse
    {
        $this->removeCartItemUseCase->execute($cartItemId);

        return response()->json([
            'message' => 'The item has been successfully deleted from your cart.',
        ], 204);
    }

    public function emptyCart(): JsonResponse
    {
        $this->emptyCartUseCase->execute(auth()->id());
        return response()->json([
            'message' => 'The cart was emptied correctly.',
        ], 200);
    }
}