<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property int $number
 * @property int $barracks_id
 *
 * @property Barracks $barracks
 * @property Soldiers[] $soldiers
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number', 'barracks_id'], 'required'],
            [['number', 'barracks_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['barracks_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barracks::className(), 'targetAttribute' => ['barracks_id' => 'id']],
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
            'number' => 'Number',
            'barracks_id' => 'Barracks ID',
        ];
    }

    /**
     * Gets query for [[Barracks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarracks()
    {
        return $this->hasOne(Barracks::className(), ['id' => 'barracks_id']);
    }

    /**
     * Gets query for [[Soldiers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoldiers()
    {
        return $this->hasMany(Soldiers::className(), ['companies_id' => 'id']);
    }
}
