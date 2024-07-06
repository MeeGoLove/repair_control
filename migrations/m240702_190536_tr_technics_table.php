<?php

use yii\db\Migration;

/**
 * Class m240702_190536_tr_technics_table
 */
class m240702_190536_tr_technics_table extends Migration
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
        $this->createTable('tr_technics', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_accounting' => $this->integer(),
            'invent_card' => $this->integer(),
            'inventory_number' => $this->string(),
            'serial_number' => $this->string(),
            'count' => $this->integer(),
            'alternative_names' => $this->string(),
            'date_add' => $this->integer()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tr_technics');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240702_190536_tr_technics_balance_table cannot be reverted.\n";

        return false;
    }
    */
}
