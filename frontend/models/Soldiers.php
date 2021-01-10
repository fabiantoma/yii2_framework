<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soldiers".
 *
 * @property int $id
 * @property string $name
 * @property string $rank
 * @property int $companies_id
 * @property int $tasks_id
 *
 * @property Companies $companies
 * @property Tasks $tasks
 */
class Soldiers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soldiers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rank', 'companies_id', 'tasks_id'], 'required'],
            [['companies_id', 'tasks_id'], 'integer'],
            [['name', 'rank'], 'string', 'max' => 255],
            [['companies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_id' => 'id']],
            [['tasks_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['tasks_id' => 'id']],
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
            'rank' => 'Rank',
            'companies_id' => 'Companies ID',
            'tasks_id' => 'Tasks ID',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['id' => 'companies_id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'tasks_id']);
    }
}
