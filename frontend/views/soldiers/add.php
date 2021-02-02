<?php

/* @var $this yii\web\View */
/* @var $soldier Soldiers */
use yii\helpers\Html;
use frontend\models\Soldiers;

use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]) ?>
    <?= $form->field($soldier, 'name') ?>
    <?= $form->field($soldier, 'rank') ?>
    <?= $form->field($soldier, 'companies_id')->dropDownList($items) ?>
    <?= $form->field($soldier, 'tasks_id')->dropDownList($tasks_items) ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>