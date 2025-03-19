<?php

namespace App\Application\UseCases;

use App\Application\Services\ProductService;

class DeleteProductUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(int $id): void
    {
        $this->productService->deleteProduct($id);
    }
}
