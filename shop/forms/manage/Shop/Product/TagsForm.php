<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * @property array $newNames
 */
class TagsForm extends Model
{
    public array $existing = [];
    public string $textNew;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->existing = ArrayHelper::getColumn($product->tagAssigments, 'tag_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
        ];
    }

    public function getNewNames(): array
    {
        return array_map('trim', preg_split('#\s*,\s#i', $this->textNew));
    }
}