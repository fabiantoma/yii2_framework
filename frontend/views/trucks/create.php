<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trucks */

$this->title = 'Create Trucks';
$this->params['breadcrumbs'][] = ['label' => 'Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trucks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
