<?php

/* @var $this yii\web\View */
/* @var $soldier Soldiers */
use yii\helpers\Html;
use frontend\models\Soldiers;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($soldier, 'name') ?>
    <?= $form->field($soldier, 'rank') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>