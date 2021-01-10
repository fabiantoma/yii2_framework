<?php

/* @var $this yii\web\View */
/* @var $df DefenceForces */
use yii\helpers\Html;
use frontend\models\DefenceForces;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($df, 'location') ?>
    <?= $form->field($df, 'number') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>