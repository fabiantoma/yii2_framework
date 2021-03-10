<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Firms */

$this->title = 'Create Firms';
$this->params['breadcrumbs'][] = ['label' => 'Firms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
