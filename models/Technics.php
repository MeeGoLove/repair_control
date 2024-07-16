<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr_technics".
 *
 * @property int $id
 * @property string $name
 * @property int|null $date_accounting
 * @property int|null $invent_card
 * @property string|null $inventory_number
 * @property string|null $serial_number
 * @property int|null $count
 * @property string|null $alternative_names
 * @property int $date_add
 */
class Technics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr_technics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_add'], 'required'],
            [['date_accounting', 'invent_card', 'count', 'date_add'], 'integer'],
            [['name', 'inventory_number', 'serial_number', 'alternative_names'], 'string'],
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
            'date_accounting' => 'Дата принятия к учету ',
            'invent_card' => 'Инвентарная карточка №',
            'inventory_number' => 'Инвентарный №',
            'serial_number' => 'Серийный №',
            'count' => 'Количество',
            'alternative_names' => 'Синонимы',
            'date_add' => 'Дата добавления',
        ];
    }
}
