<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tr_materials".
 *
 * @property int $id
 * @property string $name
 * @property int $count
 * @property string|null $alternative_names
 * @property int $date_add
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tr_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'count', 'date_add'], 'required'],
            [['count', 'date_add'], 'integer'],
            [['name', 'alternative_names'], 'string'],
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
            'count' => 'Количество',
            'alternative_names' => 'Синонимы',
            'date_add' => 'Дата добавления',
        ];
    }
}
