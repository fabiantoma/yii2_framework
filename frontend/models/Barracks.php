<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barracks".
 *
 * @property int $id
 * @property string $name
 * @property int $number
 * @property int $df_id
 *
 * @property DefenceForces $df
 * @property Companies[] $companies
 */
class Barracks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barracks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number', 'df_id'], 'required'],
            [['number', 'df_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['df_id'], 'exist', 'skipOnError' => true, 'targetClass' => DefenceForces::className(), 'targetAttribute' => ['df_id' => 'id']],
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
            'df_id' => 'Df ID',
        ];
    }

    /**
     * Gets query for [[Df]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDf()
    {
        return $this->hasOne(DefenceForces::className(), ['id' => 'df_id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['barracks_id' => 'id']);
    }
}
