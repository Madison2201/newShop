<?php
/**
 * @var  $this yii\web\View
 * @var $category shop\entities\Shop\Category
 * @var $model shop\forms\manage\Shop\CategoryForm
 */
$this->title = 'Update Category ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="brand-update">
    <?= $this->render('_form', ['model' => $model,]) ?>
</div>
