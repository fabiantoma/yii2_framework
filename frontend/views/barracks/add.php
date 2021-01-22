<?php

/* @var $this yii\web\View */
/* @var $barrack Barracks */
use yii\helpers\Html;
use frontend\models\Barracks;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($barrack, 'name') ?>
    <?= $form->field($barrack, 'number') ?>
    <?= $form->field($barrack, 'df_id')->dropDownList($items) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>