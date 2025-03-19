<?php

namespace App\Application\Services;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use App\Domain\DTOs\ProductDTO;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Crea un nuevo producto a partir de un DTO.
     *
     * @param ProductDTO $productDTO Datos del producto a crear.
     * @return Product El producto creado.
     */
    public function createProduct(ProductDTO $productDTO): Product
    {
        $product = new Product(0, $productDTO->name, $productDTO->description, $productDTO->price, $productDTO->stock);
        $this->productRepository->save($product);
        return $product;
    }

    /**
     * Obtiene todos los productos disponibles.
     *
     * @return array Lista de productos en formato de array.
     */
    public function getAllProducts(): array
    {
        $products = $this->productRepository->findAll();

        return array_map(fn($product) => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'stock' => $product->getStock(),
        ], $products);
    }

    /**
     * Obtiene un producto por su ID.
     *
     * @param int $id ID del producto a buscar.
     * @return Product|null Retorna el producto si se encuentra, de lo contrario null.
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    } 

    /**
     * Actualiza los datos de un producto existente.
     *
     * @param int $id ID del producto a actualizar.
     * @param ProductDTO $productDTO Datos nuevos del producto.
     * @return Product El producto actualizado.
     * @throws \Exception Si el producto no es encontrado.
     */
    public function updateProduct(int $id, ProductDTO $productDTO): Product
    {
        $product = $this->productRepository->findById($id);
        $product->setName($productDTO->name);
        $product->setDescription($productDTO->description);
        $product->setPrice($productDTO->price);
        $product->setStock($productDTO->stock);

        $this->productRepository->update($product);

        return $product;
    }

    /**
     * Elimina un producto por su ID.
     *
     * @param int $id ID del producto a eliminar.
     * @return void
     */
    public function deleteProduct(int $id): void
    {
        $this->productRepository->delete($id);
    }
}
