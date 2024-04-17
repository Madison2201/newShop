<?php
/**
 * @var $this yii\web\View
 * @var $model shop\forms\manage\Shop\BrandForm
 * @var $form yii\widgets\ActiveForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tag-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card card-default">
        <div class="card-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>
