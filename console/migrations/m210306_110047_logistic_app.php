<?php

use yii\db\Migration;

/**
 * Class m210306_110047_logistic_app
 */
class m210306_110047_logistic_app extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('firms',[
            'id' => $this->primaryKey(5),
            'name'=> $this->string()->notNull(),
            'location'=>$this->string()->notNull(),
            'products'=>$this->string()->notNull(),
        ]);
        
        $this->createTable('drivers',[
            'id' =>$this->primaryKey(5),
            'name'=>$this->string()->notNull(),
            'email'=>$this->string()->notNull(),
            'address'=>$this->string()->notNull(),
            'drivers_firms_id'=>$this->integer()->notNull(),
        ]);
        
        $this->createTable('trucks',[
            'id' =>$this->primaryKey(5),
            'type'=>$this->string()->notNull(),
            'platenumber'=>$this->string()->notNull(),
            'fuel_type'=>$this->string()->notNull(),
            'trucks_firms_id'=>$this->integer()->notNull(),
        ]);
        
        $this->createTable('transport',[
            'id' =>$this->primaryKey(5),
            'cargo_type'=>$this->string()->notNull(),
            'date'=>$this->dateTime()->notNull(),
            'on_way'=>$this->boolean()->defaultValue(true),
            'transport_trucks_id'=>$this->integer()->notNull(),
        ]);
        
        
        
        
        $this->addForeignKey('fk_drivers_firms_id','drivers','drivers_firms_id','firms','id');
        $this->addForeignKey('fk_trucks_firms_id','trucks','trucks_firms_id','firms','id');
        $this->addForeignKey('fk_transport_trucks_id','transport','transport_trucks_id','trucks','id');

        $this->addColumn('transport','starting_point', $this->string()->notNull());
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210306_110047_logistic_app cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210306_110047_logistic_app cannot be reverted.\n";

        return false;
    }
    */
}
