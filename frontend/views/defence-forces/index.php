<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\Migration;

//$this->title = 'Defence Forces';
//$this->params['breadcrumbs'][] = $this->title;


class military extends Migration
{

 public function safeUp(){
$this->createTable('military',[
    'id' => $this->primaryKey(),
    'name'=> $this->string()->notNull(),
    'number'=>$this->integer()->notNull(),
    
    ]);
    $this->createTable('units',[
    'id' =>$this->primaryKey(),
    'name'=>$this->string()->notNull(),
    'location'=> $this->string()->notNull(),
    'number'=>$this->integer()->notNull(),
    'mil_id'=>$this->integer()->notNull(),
    ]);
    $this->createTable('battalions',[
    'id' =>$this->primaryKey(),
    'name'=>$this->string()->notNull(),
    'location'=> $this->string()->notNull(),
    'number'=>$this->integer()->notNull(),
    'un_id'=>$this->integer()->notNull(),
    ]);
    $this->createTable('coy',[
    'id' =>$this->primaryKey(),
    'name'=>$this->string()->notNull(),
    'number'=>$this->integer()->notNull(),
    'bat_id'=>$this->integer()->notNull(),
    ]);
    $this->createTable('mission',[
    'id' =>$this->primaryKey(),
    'name'=>$this->string()->notNull(),
    'picture'=>$this->imageFile(),
    'date'=>$this->dateTime()->notNull(),
    ]);
    $this->createTable('warrior',[
    'id' =>$this->primaryKey(),
    'name' =>$this->string()->notNull(),
    'coy_id' =>$this->integer()->notNull(),
    'mission_id' =>$this->integer()->notNull(),
    ]);
    $this->addForeignKey('fk_mil_id','units','military_id','military','id');
    $this->addForeignKey('fk_un_id','battalions','units_id','units','id');
    $this->addForeignKey('fk_bat_id','coy','battalions_id','battalions','id');
    $this->addForeignKey('fk_coy_id','warrior','coy_id','coy','id');
    $this->addForeignKey('fk_mission_id','warrior','mission_id','mission','id');
    
}

/**
* {@inheritdoc}
*/
public function safeDown()
{
$this->dropTable('military');
$this->dropTable('units');
$this->dropTable('battalions');
$this->dropTable('coy');
$this->dropTable('mission');
$this->dropTable('warrior');
}
};





?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the Defence Forces page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>