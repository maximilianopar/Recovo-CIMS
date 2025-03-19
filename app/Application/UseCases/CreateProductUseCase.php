<?php

namespace App\Application\UseCases;

use App\Application\Services\ProductService;
use App\Domain\DTOs\ProductDTO;
use App\Domain\Entities\Product;

class CreateProductUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(ProductDTO $productDTO): Product
    {
        return $this->productService->createProduct($productDTO);
    }
}
