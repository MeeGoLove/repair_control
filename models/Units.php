<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "units".
 *
 * @property int $id
 * @property string $name
 *
 * @property Mol[] $mols
 * @property RawTechnics[] $rawTechnics
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[Mols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMols()
    {
        return $this->hasMany(Mol::class, ['unit_id' => 'id']);
    }

    /**
     * Gets query for [[RawTechnics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawTechnics()
    {
        return $this->hasMany(RawTechnics::class, ['unit_id' => 'id']);
    }
}
