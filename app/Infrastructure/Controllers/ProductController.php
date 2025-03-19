<?php

namespace App\Infrastructure\Controllers;

use App\Application\UseCases\CreateProductUseCase;
use App\Application\UseCases\GetAllProductsUseCase;
use App\Application\UseCases\GetProductByIdUseCase;
use App\Application\UseCases\UpdateProductUseCase;
use App\Application\UseCases\DeleteProductUseCase;
use App\Domain\DTOs\ProductDTO;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(
        private CreateProductUseCase $createProductUseCase,
        private GetAllProductsUseCase $getAllProductsUseCase,
        private GetProductByIdUseCase $getProductByIdUseCase,
        private UpdateProductUseCase $updateProductUseCase,
        private DeleteProductUseCase $deleteProductUseCase,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllProductsUseCase->execute());
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
    $validatedData = $request->validated();

    $productDTO = new ProductDTO(
        $validatedData['name'],
        $validatedData['description'],
        $validatedData['price'],
        $validatedData['stock']
    );

    $product = $this->createProductUseCase->execute($productDTO);

    return response()->json([
        'message' => 'Product saved successfully:',
        'product' => [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'stock' => $product->getStock(),
        ],
    ], 201);
        
    }

    public function show($id): JsonResponse
    {
        $product = $this->getProductByIdUseCase->execute($id);

        if ($product === null) {
            return response()->json([
                'message' => 'There are no products to show',
            ], 404);
        }
    
        $productArray = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'stock' => $product->getStock(),
        ];
    
        return response()->json([
            'message' => 'Product details:',
            'product' => $productArray,
        ], 200);
    }
    

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        $productDTO = new ProductDTO(
            $validatedData['name'],
            $validatedData['description'],
            $validatedData['price'],
            $validatedData['stock']
        );

        $updatedProduct = $this->updateProductUseCase->execute($id, $productDTO);
        return response()->json([
            'message' => 'Product successfully updated, new data:',
            'id' => $updatedProduct->getId(),
            'name' => $updatedProduct->getName(),
            'price' => $updatedProduct->getPrice(),
            'stock' => $updatedProduct->getStock(),
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->deleteProductUseCase->execute($id);
        return response()->json([
            'message' => 'Product successfully deleted:',
        ], 201);
    }
}
