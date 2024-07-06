<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfers".
 *
 * @property int $id
 * @property string $name
 * @property string|null $comment
 * @property string|null $inventory_number
 * @property string|null $serial_number
 * @property int $count
 * @property int $date
 * @property int|null $unit_id
 * @property string $ref_table_name
 * @property int $ref_table_id
 * @property int $user_id
 */
class Transfers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'count', 'date', 'ref_table_name', 'ref_table_id', 'user_id'], 'required'],
            [['count', 'date', 'unit_id', 'ref_table_id', 'user_id'], 'integer'],
            [['name', 'comment', 'inventory_number', 'serial_number', 'ref_table_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'comment' => 'Комментарий',
            'inventory_number' => 'Инвентарный №',
            'serial_number' => 'Серийный №',
            'count' => 'Количество',
            'date' => 'Дата',
            'unit_id' => 'Отделение',
            'ref_table_name' => 'С какой таблицы',
            'ref_table_id' => 'ID исходной записи',
            'user_id' => 'Выдал',
        ];
    }
}
