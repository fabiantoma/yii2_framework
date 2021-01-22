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