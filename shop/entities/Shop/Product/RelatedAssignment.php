<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $related_id;
 */
class RelatedAssignment extends ActiveRecord
{
    public static function create(int $productId): self
    {
        $assignment = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function isForProduct(int $id): bool
    {
        return $this->related_id === $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_related_assignments}}';
    }
}