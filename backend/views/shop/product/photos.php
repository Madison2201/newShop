<?php

/**
 * @var $this yii\web\View
 * @var $model shop\forms\manage\Shop\Product\ProductCreateForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Price Photos';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Price';
