<?php

use yii\db\Migration;

/**
 * Class m240625_060515_mol_table
 */
class m240625_060515_mol_table extends Migration
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
        $this->createTable('mol', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'unit_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_unit_id_mol',  // это "условное имя" ключа
            'mol', // это название текущей таблицы
            'unit_id', // это имя поля в текущей таблице, которое будет ключом
            'units', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mol');
        $this->dropForeignKey(
            'fk_unit_id_mol',
            'mol'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240625_060515_mol_table cannot be reverted.\n";

        return false;
    }
    */
}
