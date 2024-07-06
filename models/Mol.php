<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mol".
 *
 * @property int $id
 * @property string $name
 * @property int|null $unit_id
 *
 * @property RawTechnics[] $rawTechnics
 * @property Units $unit
 */
class Mol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['unit_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Имя',
            'unit_id' => 'Отделение',
        ];
    }

    /**
     * Gets query for [[RawTechnics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawTechnics()
    {
        return $this->hasMany(RawTechnics::class, ['mol_id' => 'id']);
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
