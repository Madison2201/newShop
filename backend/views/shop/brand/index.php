<?php

use kartik\widgets\DatePicker;
use shop\entities\Shop\Brand;
use shop\entities\User\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use shop\helpers\UserHelper;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\forms\Shop\BrandSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */
$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">


    <p>
        <?= Html::a('Create Brand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Brand $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'slug',
                    [
                        'class' => ActionColumn::class,
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
