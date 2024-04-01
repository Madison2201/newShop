<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property string $file
 * @property integer $sort
 */
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort(string $sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo(int $id): bool
    {
        return $this->id === $id;
    }

    public static function tableName(): string
    {
        return "{{%shop_photos}}";
    }
}