<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property integer $product_id
 * @property integer $category_id
 */
class CategoryAssignment extends ActiveRecord
{
    public static function create(int $categoryId): self
    {
        $assigment = new static();
        $assigment->category_id = $categoryId;
        return $assigment;
    }

    public function isForCategory(int $id): bool
    {
        return $this->category_id == $id;
    }

    public static function tableName(): string
    {
        return "{{%shop_category_assignments}}";
    }
}