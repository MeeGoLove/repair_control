<?php

use yii\db\Migration;

/**
 * Class m240702_190458_transfers_table
 */
class m240702_190458_transfers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('transfers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'comment' => $this->string(),
            'inventory_number' => $this->string(),
            'serial_number' => $this->string(),
            'count' => $this->integer()->notNull(),
            'date' => $this->integer()->notNull(),
            'unit_id' => $this->integer(),
            'ref_table_name' => $this->string()->notNull(),
            'ref_table_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transfers');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240702_190458_transfers_table cannot be reverted.\n";

        return false;
    }
    */
}
