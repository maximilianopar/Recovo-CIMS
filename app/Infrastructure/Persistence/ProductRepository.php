<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Product as ProductEntity;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Exceptions\CartItemNotFoundException;
use App\Models\Product as ProductModel;
use Exception;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Encuentra un producto por su ID.
     *
     * @param int $id
     * @return ProductEntity|null
     */
    public function findById(int $id): ?ProductEntity
    {
        $productModel = ProductModel::find($id);
        if (!$productModel) {
            throw new Exception("Cannot update because the specified product was not found.", 404);
        }
        return $this->mapToEntity($productModel);
    }

    /**
     * Obtiene todos los productos 
     *
     * @return Product[]
     */
    public function findAll(): array
    {
        $products = ProductModel::all();
    
        if ($products->isEmpty()) {

            throw new Exception("No products found.");
        }
        return $products
        ->map(fn($product) => $this->mapToEntity($product))
        ->toArray();
    }

    /**
     * Guarda un Product en la base de datos.
     *
     * @param ProductEntity $product
     * @return ProductEntity
     */
    public function save(ProductEntity $product): ProductEntity
    {
        $productModel = $this->mapToModel($product);
        $productModel->save();
       
        return $this->mapToEntity($productModel);
    }

     /**
     * Actualiza los valores de un producto
     *
     * */
    public function update(ProductEntity $product): ProductEntity
    {

        $cartItemModel = ProductModel::find($product->getId());

        if (!$cartItemModel) {
            throw new Exception("Product cannot be updated because it does not exist.", 404);
        }
        $cartItemModel->name = $product->getName();
        $cartItemModel->description = $product->getDescription();
        $cartItemModel->price = $product->getPrice();
        $cartItemModel->stock = $product->getStock();
        $cartItemModel->save();

        return $this->mapToEntity($cartItemModel);
    }
    
    /**
     * Elimina un Product por su ID.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $productModel = ProductModel::find($id);
        
        if (!$productModel) {
            throw new Exception("Product cannot be deleted because it does not exist.", 404);
        }
        
        $productModel->delete();
    }


    /**
     * Mapea la entidad Product (dominio) a un modelo Product (Eloquent).
     *
     * @param ProductEntity $product
     * @return ProductModel
     */
    private function mapToModel(ProductEntity $product): ProductModel
    {
        $productModel = new ProductModel();
        $productModel->id = $product->getId();
        $productModel->name = $product->getName();
        $productModel->description = $product->getDescription();
        $productModel->price = $product->getPrice();
        $productModel->stock = $product->getStock();

        return $productModel;
    }

    /**
     * Mapea un modelo Product (Eloquent) a una entidad Product (dominio).
     *
     * @param ProductModel $productModel
     * @return ProductEntity
     */
    private function mapToEntity(ProductModel $productModel): ProductEntity
    { 
        return new ProductEntity(
            $productModel->id,
            $productModel->name,
            $productModel->description,
            $productModel->price,
            $productModel->stock,
        );
    }
}
