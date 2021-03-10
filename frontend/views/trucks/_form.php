<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Trucks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trucks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'platenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trucks_firms_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
