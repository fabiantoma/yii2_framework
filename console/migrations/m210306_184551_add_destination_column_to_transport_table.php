<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%transport}}`.
 */
class m210306_184551_add_destination_column_to_transport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%transport}}', 'position', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transport}}', 'position');
    }
}
