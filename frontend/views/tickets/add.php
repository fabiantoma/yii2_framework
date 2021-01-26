<?php

/* @var $this yii\web\View */
/* @var $soldier Soldiers */
use yii\helpers\Html;
use frontend\models\Tickets;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($ticket, 'title') ?>
    <?= $form->field($ticket, 'description') ?>
    <?= $form->field($ticket, 'picture') ?>
    <?= $form->field($ticket, 'is_open') ?>
    <?= $form->field($ticket, 'date') ?>
    <?= $form->field($ticket, 'user_id')->dropDownList($items) ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>