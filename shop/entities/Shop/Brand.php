<?php

namespace shop\entities\Shop;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    public Meta $meta;

    public static function create(string $name, string $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit(string $name, string $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public static function tableName(): string
    {
        return "{{%shop_brands}}";
    }

    public function behaviors(): array
    {
        return [
            'class' => MetaBehavior::class,
//            'jsonAttribute' => 'meta_json',
        ];
    }
}