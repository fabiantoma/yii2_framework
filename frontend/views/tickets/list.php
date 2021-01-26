<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Tickets;
use frontend\models\User;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

echo GridView::widget([
    'dataProvider' => $list,
    'columns' => [
        'id',
        'title',
        'description',
        'picture',
        'is_open',
        'date',
        'user_id'
        
    ],
]);
echo Html::beginForm(['tickets/update', 'id' => 'update'], 'post' );
echo Html::input('text', 'update_id', '');
echo Html::submitButton('Update', ['class' => 'update']);
echo Html::endForm();

echo "<br />";


echo Html::beginForm(['tickets/delete', 'id' => 'delete'], 'post' );
echo Html::input('text', 'delete_id', '');
echo Html::submitButton('Delete', ['class' => 'delete']);
echo Html::endForm();