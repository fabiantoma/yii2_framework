<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "defence_forces".
 *
 * @property int $id
 * @property string $location
 * @property int $number
 *
 * @property Barracks[] $barracks
 */
class DefenceForces extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'defence_forces';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'number'], 'required'],
            [['number'], 'integer'],
            [['location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
            'number' => 'Number',
        ];
    }

    /**
     * Gets query for [[Barracks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarracks()
    {
        return $this->hasMany(Barracks::className(), ['df_id' => 'id']);
    }
}
