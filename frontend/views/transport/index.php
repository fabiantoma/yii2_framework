<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transport', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cargo_type',
            'date',
            'on_way',
            'transport_trucks_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
