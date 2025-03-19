<?php

namespace App\Application\UseCases;

use App\Application\Services\ProductService;
use App\Domain\DTOs\ProductDTO;
use App\Domain\Entities\Product;

class UpdateProductUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(int $id, ProductDTO $productDTO): Product
    {
        return $this->productService->updateProduct($id, $productDTO);
    }
}