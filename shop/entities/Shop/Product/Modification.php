<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $price
 * @property int $quantity
 */
class Modification extends ActiveRecord
{
    public static function create(string $code, string $name, string $price, int $quantity): self
    {
        $modification = new static();
        $modification->code = $code;
        $modification->name = $name;
        $modification->price = $price;
        $modification->quantity = $quantity;
        return $modification;
    }

    public function edit(string $code, string $name, string $price, int $quantity): void
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function isIdEqualTo(int $id): bool
    {
        return $this->id === $id;
    }

    public function isCodeEqualTo(string $code): bool
    {
        return $this->code === $code;
    }

    public static function tableName(): string
    {
        return "{{%shop_modifications}}";
    }
}