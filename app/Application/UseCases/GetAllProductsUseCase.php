<?php

namespace App\Application\UseCases;

use App\Application\Services\ProductService;

class GetAllProductsUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(): array
    {
        return $this->productService->getAllProducts();
    }
}
