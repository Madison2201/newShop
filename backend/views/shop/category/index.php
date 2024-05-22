<?php

use shop\entities\Shop\Category;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel backend\forms\Shop\CategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */
$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">


    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Category $model) {
                            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                            return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'value' => function (Category $model) {
                            return Html::a('<span class="fas fa-arrow-up"></span>', ['move-up', 'id' => $model->id],
                                    ['data-method' => 'POST']) .
                                Html::a('<span class="fas fa-arrow-down"></span>', ['move-down', 'id' => $model->id],
                                    ['data-method' => 'POST']);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align: center;'],
                    ],
                    'slug',
                    'title',
                    [
                        'class' => ActionColumn::class,
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
