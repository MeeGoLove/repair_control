<?php

use yii\db\Migration;

/**
 * Class m240625_060523_raw_technics_table
 */
class m240625_060523_raw_technics_table extends Migration
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
        $this->createTable('raw_technics', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_accounting' => $this->integer()->notNull(),
            'date_manufacture' => $this->integer(),
            'inventory_number' => $this->string()->notNull(),
            'invent_card' => $this->integer(),
            'serial_number' => $this->string(),
            'mol_id' => $this->integer(),
            'unit_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_unit_id_raw_technics',  // это "условное имя" ключа
            'raw_technics', // это название текущей таблицы
            'unit_id', // это имя поля в текущей таблице, которое будет ключом
            'units', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL'
        );
        $this->addForeignKey(
            'fk_mol_id_raw_technics',  // это "условное имя" ключа
            'raw_technics', // это название текущей таблицы
            'mol_id', // это имя поля в текущей таблице, которое будет ключом
            'mol', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('raw_technics');
        $this->dropForeignKey(
            'fk_unit_id_raw_technics',
            'raw_technics'
        );
        $this->dropForeignKey(
            'fk_mol_id_raw_technics',
            'raw_technics'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240625_060523_raw_technics_table cannot be reverted.\n";

        return false;
    }
    */
}
