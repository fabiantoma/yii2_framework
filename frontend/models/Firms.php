<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "firms".
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $products
 *
 * @property Drivers[] $drivers
 * @property Trucks[] $trucks
 */
class Firms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'firms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location', 'products'], 'required'],
            [['name', 'location', 'products'], 'string', 'max' => 255],
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
            'location' => 'Location',
            'products' => 'Products',
        ];
    }

    /**
     * Gets query for [[Drivers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDrivers()
    {
        return $this->hasMany(Drivers::className(), ['drivers_firms_id' => 'id']);
    }

    /**
     * Gets query for [[Trucks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrucks()
    {
        return $this->hasMany(Trucks::className(), ['trucks_firms_id' => 'id']);
    }
}
