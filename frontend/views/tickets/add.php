<?php

/* @var $this yii\web\View */
/* @var $ticket Tickets */
use yii\helpers\Html;
use frontend\models\Tickets;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($ticket, 'title') ?>
    <?= $form->field($ticket, 'description') ?>
    <?= $form->field($ticket, 'imageFile')->fileInput() ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>