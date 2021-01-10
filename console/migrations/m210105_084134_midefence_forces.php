<?php

use yii\db\Migration;


/**
 * Class m210105_084134_midefence_forces
 */
class m210105_084134_midefence_forces extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('defence_forces',[
            'id' => $this->primaryKey(5),
            'location'=> $this->string()->notNull(),
            'number'=>$this->integer()->notNull(),
        ]);
        
        $this->createTable('barracks',[
            'id' =>$this->primaryKey(5),
            'name'=>$this->string()->notNull(),
            'number'=>$this->integer()->notNull(),
            'df_id'=>$this->integer()->notNull(),
        ]);
        
        $this->createTable('companies',[
            'id' =>$this->primaryKey(5),
            'name'=>$this->string()->notNull(),
            'number'=>$this->integer()->notNull(),
            'barracks_id'=>$this->integer()->notNull(),
        ]);
        
        $this->createTable('tasks',[
            'id' =>$this->primaryKey(5),
            'name'=>$this->string()->notNull(),
            'date'=>$this->dateTime()->notNull(),
            
        ]);
        
        $this->createTable('soldiers',[
            'id' =>$this->primaryKey(5),
            'name' =>$this->string()->notNull(),
            'rank' =>$this->string()->notNull(),
            'companies_id' =>$this->integer()->notNull(),
            'tasks_id' =>$this->integer()->notNull(),
        ]);
        
        
        $this->addForeignKey('fk_df_id','barracks','df_id','defence_forces','id');
        $this->addForeignKey('fk_barracks_id','companies','barracks_id','barracks','id');
        $this->addForeignKey('fk_companies_id','soldiers','companies_id','companies','id');
        $this->addForeignKey('fk_tasks_id','soldiers','tasks_id','tasks','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('defence_forces');
        $this->dropTable('barracks');
        $this->dropTable('companies');
        $this->dropTable('tasks');
        $this->dropTable('soldiers');
      
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210105_084134_midefence_forces cannot be reverted.\n";

        return false;
    }
    */
}
