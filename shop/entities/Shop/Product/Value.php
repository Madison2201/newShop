<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property integer $characteristic_id
 * @property  string $value
 */
class Value extends ActiveRecord
{
    public static function create(int $characteristicId, string $value): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        $object->value = $value;
        return $object;
    }

    public static function blank(int $characteristicId): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        return $object;
    }

    public function isForCharacteristic(int $id): bool
    {
        return $this->characteristic_id == $id;
    }
}