<?php

/* @var $this yii\web\View */
/* @var $task Tasks */
use yii\helpers\Html;
use frontend\models\Tasks;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($task, 'name') ?>
    <?= $form->field($task, 'date') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>