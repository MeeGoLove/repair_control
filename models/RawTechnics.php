<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raw_technics".
 *
 * @property int $id
 * @property string $name
 * @property int $date_accounting
 * @property int|null $date_manufacture
 * @property string $inventory_number
 * @property int|null $invent_card
 * @property string|null $serial_number
 * @property int|null $mol_id
 * @property int|null $unit_id
 *
 * @property Mol $mol
 * @property Units $unit
 */
class RawTechnics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_technics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_accounting', 'inventory_number'], 'required'],
            [['date_accounting', 'invent_card', 'mol_id', 'unit_id'], 'integer'],
            //[['name', 'inventory_number', 'serial_number'], 'string', 'max' => 255],
            [['mol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mol::class, 'targetAttribute' => ['mol_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::class, 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_accounting' => 'Date Accounting',
            'date_manufacture' => 'Date Manufacture',
            'inventory_number' => 'Inventory Number',
            'invent_card' => 'Invent Card',
            'serial_number' => 'Serial Number',
            'mol_id' => 'Mol ID',
            'unit_id' => 'Unit ID',
        ];
    }

    /**
     * Gets query for [[Mol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMol()
    {
        return $this->hasOne(Mol::class, ['id' => 'mol_id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::class, ['id' => 'unit_id']);
    }
}
