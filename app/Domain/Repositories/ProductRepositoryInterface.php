<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function findAll(): array;
    public function save(Product $product): Product;
    public function update(Product $product): Product;
    public function delete(int $id): void;
}
