<?php

use yii\db\Migration;

/**
 * Class m240702_190610_tr_materials_table
 */
class m240702_190610_tr_materials_table extends Migration
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
        $this->createTable('tr_materials', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'count' => $this->integer()->notNull(),
            'alternative_names' => $this->string(),
            'date_add' => $this->integer()->notNull()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tr_materials');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240702_190610_tr__materials_table cannot be reverted.\n";

        return false;
    }
    */
}
