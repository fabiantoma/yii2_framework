<?php

/* @var $this yii\web\View */
/* @var $company Companies  */
use yii\helpers\Html;
use frontend\models\Companies;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($company, 'name') ?>
    <?= $form->field($company, 'number') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>