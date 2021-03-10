<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property int $drivers_firms_id
 *
 * @property Firms $driversFirms
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'address', 'drivers_firms_id'], 'required'],
            [['drivers_firms_id'], 'integer'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            [['drivers_firms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Firms::className(), 'targetAttribute' => ['drivers_firms_id' => 'id']],
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
            'email' => 'Email',
            'address' => 'Address',
            'drivers_firms_id' => 'Firms',
        ];
    }

    /**
     * Gets query for [[DriversFirms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriversFirms()
    {
        return $this->hasOne(Firms::className(), ['id' => 'drivers_firms_id']);
    }
}
