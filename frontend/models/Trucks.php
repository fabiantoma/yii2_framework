<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trucks".
 *
 * @property int $id
 * @property string $type
 * @property string $platenumber
 * @property string $fuel_type
 * @property int $trucks_firms_id
 *
 * @property Transport[] $transports
 * @property Firms $trucksFirms
 */
class Trucks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trucks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'platenumber', 'fuel_type', 'trucks_firms_id'], 'required'],
            [['trucks_firms_id'], 'integer'],
            [['type', 'platenumber', 'fuel_type'], 'string', 'max' => 255],
            [['trucks_firms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Firms::className(), 'targetAttribute' => ['trucks_firms_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'platenumber' => 'Platenumber',
            'fuel_type' => 'Fuel Type',
            'trucks_firms_id' => 'Trucks Firms ID',
        ];
    }

    /**
     * Gets query for [[Transports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransports()
    {
        return $this->hasMany(Transport::className(), ['transport_trucks_id' => 'id']);
    }

    /**
     * Gets query for [[TrucksFirms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrucksFirms()
    {
        return $this->hasOne(Firms::className(), ['id' => 'trucks_firms_id']);
    }
}
