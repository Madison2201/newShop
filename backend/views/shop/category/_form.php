<?php
/**
 * @var $this yii\web\View
 * @var $model shop\forms\manage\Shop\CategoryForm
 * @var $form yii\widgets\ActiveForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card card-default">
        <div class="card-header with-border">Common</div>
        <div class="card-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
        </div>
    </div>

    <div class="card card-default">
        <div class="card-header with-border">SEO</div>
        <div class="card-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>
