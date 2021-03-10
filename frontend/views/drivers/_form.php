<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Firms;

/* @var $this yii\web\View */
/* @var $model app\models\Drivers */
/* @var $form yii\widgets\ActiveForm */
?>




<div class="drivers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drivers_firms_id')->dropDownList(
        ArrayHelper::map(Firms::find()->all(),'id','name'),
        [
            'prompt'=>'Select Firms',
        ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
