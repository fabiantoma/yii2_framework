<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Tickets;
use frontend\models\User;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;

echo GridView::widget([
    'dataProvider' => $list,
    'columns' => [
        'id',
        'title',
        'description',
        'picture',
        'is_open:boolean',
        'date',
        [
            'class' => ActionColumn::className(),
            'template' => '{view}',
            // you may configure additional properties here
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{delete}',
            // you may configure additional properties here
        ],
        [
            'class' => ActionColumn::className(),
            'buttons'=>[
                'update' => function ($url, $model, $key) {
                    return   Html::a('Rendel', '/site/assign?id='.$model->id) ;
                },
            ]
           
            // you may configure additional properties here
        ],
        [
            'class' => ActionColumn::className(),
            'buttons'=>[
                'update' => function ($url, $model, $key) {
                    return   Html::a('Close', '/site/close?id='.$model->id) ;
                },
            ]
           
            // you may configure additional properties here
        ],
    ],
]);
