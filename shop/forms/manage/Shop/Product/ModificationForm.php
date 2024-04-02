<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    public string $code;
    public string $name;
    public string $price;
    public mixed $quantity;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification) {
            $this->code = $modification->code;
            $this->name = $modification->name;
            $this->price = $modification->price;
            $this->quantity = $modification->quantity;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['code', 'name', 'quantity'], 'required'],
            [['price'], 'integer'],
        ];
    }
}