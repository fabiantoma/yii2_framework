<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Companies;
use frontend\models\Barracks;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

echo GridView::widget([
    'dataProvider' => $list,
    'columns' => [
        'id',
        'name',
        'number',
        'barracks.name'
        
    ],
]);

