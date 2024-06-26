<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use shop\repositories\NotFoundException;

class ProductRepository
{
    public function get(int $id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $product;
    }

    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function existsByBrand(int $id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }
    public function existsByMainCategory(int $id): bool
    {
        return Category::find()->andWhere(['category_id' => $id])->exists();
    }
}