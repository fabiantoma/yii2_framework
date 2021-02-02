<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use frontend\models\Tickets;
use frontend\models\User;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;


$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;


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

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the Tickets page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>