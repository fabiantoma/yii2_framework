<?php

use yii\db\Migration;

/**
 * Class m210117_134200_ticket_system
 */
class m210117_134200_ticket_system extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('tickets',[
            'id' =>$this->primaryKey(5),
            'title'=>$this->string()->notNull(),
            'description'=>$this->string()->notNull(),
            'picture'=>$this->string(),
            'is_open'=>$this->boolean()->defaultValue(true),
            'date'=>$this->dateTime()->notNull(),
            'user_id'=>$this->integer()->notNull(),
        ]);
        $this->createTable('comments',[
            'id' =>$this->primaryKey(5),
            'title'=>$this->string()->notNull(),
            'opinion'=>$this->string()->notNull(),
            'date'=>$this->dateTime()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'tickets_id'=>$this->integer()->notNull(),
        
        ]);
        
        
        $this->addForeignKey('fk_user_id','tickets','user_id','user','id');
        $this->addForeignKey('fk_commentuser_id','comments','user_id','user','id');
        $this->addForeignKey('fk_tickets_id','comments','tickets_id','tickets','id');
        
        $this->addColumn('user','is_admin', $this->boolean()->defaultValue(false));
    



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210117_134200_ticket_system cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210117_134200_ticket_system cannot be reverted.\n";

        return false;
    }
    */
}
