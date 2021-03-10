<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport".
 *
 * @property int $id
 * @property string $cargo_type
 * @property string $date
 * @property int|null $on_way
 * @property int $transport_trucks_id
 *
 * @property Trucks $transportTrucks
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargo_type', 'date', 'transport_trucks_id'], 'required'],
            [['date'], 'safe'],
            [['on_way', 'transport_trucks_id'], 'integer'],
            [['cargo_type'], 'string', 'max' => 255],
            [['transport_trucks_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trucks::className(), 'targetAttribute' => ['transport_trucks_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cargo_type' => 'Cargo Type',
            'date' => 'Date',
            'on_way' => 'On Way',
            'transport_trucks_id' => 'Transport Trucks ID',
        ];
    }

    /**
     * Gets query for [[TransportTrucks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransportTrucks()
    {
        return $this->hasOne(Trucks::className(), ['id' => 'transport_trucks_id']);
    }
}
