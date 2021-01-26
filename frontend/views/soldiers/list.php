<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Soldiers;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

echo GridView::widget([
    'dataProvider' => $list,
    'columns' => [
        'id',
        'name',
        'rank',
        'companies.name',
        'tasks.name'
        
    ],
]);

echo Html::beginForm(['soldiers/update', 'id' => 'update'], 'post' );
echo Html::input('text', 'update_id', '');
echo Html::submitButton('Update', ['class' => 'update']);
echo Html::endForm();

echo "<br />";


echo Html::beginForm(['soldiers/delete', 'id' => 'delete'], 'post' );
echo Html::input('text', 'delete_id', '');
echo Html::submitButton('Delete', ['class' => 'delete']);
echo Html::endForm();