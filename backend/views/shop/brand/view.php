<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var $model shop\forms\manage\Shop\BrandForm */
/** @var $brand shop\entities\Shop\Brand */

$this->title = 'View brands - ' . $brand->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $brand->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $brand->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="card">
        <div class="card-header with-border">Common</div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $brand,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header with-border">SEO</div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $brand,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>


</div>
