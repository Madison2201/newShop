<?php

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Brand;
use shop\forms\manage\MetaForm;
use yii\base\Model;

class BrandForm extends Model
{
    public string $name;
    public string $slug;

    private $_meta;
    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name = $brand->name;
            $this->slug = $brand->slug;
            $this->_meta = new MetaForm($brand->meta);
            $this->_brand = $brand;
        }
        parent::__construct($config);
    }

    public function load($data, $formName = null): bool
    {
        $self = parent::load($data, $formName);
        $meta = $this->_meta->load($data, $formName ? null : 'meta');
        return $self && $meta;
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '#^[a-z0-9_-]*$#s'],
            [['name', 'slug'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null],
        ];
    }
}