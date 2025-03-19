<?php

namespace App\Application\UseCases;

use App\Application\Services\ProductService;
use App\Domain\Entities\Product;

class GetProductByIdUseCase
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function execute(int $id): ?Product
    {
        return $this->productService->getProductById($id);
    }
}
