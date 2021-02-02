<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $title
 * @property string $opinion
 * @property string $date
 * @property int $user_id
 * @property int $tickets_id
 *
 * @property User $user
 * @property Tickets $tickets
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'opinion', 'date', 'user_id', 'tickets_id'], 'required'],
            [['date'], 'safe'],
            [['user_id', 'tickets_id'], 'integer'],
            [['title', 'opinion'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['tickets_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::className(), 'targetAttribute' => ['tickets_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'opinion' => 'Opinion',
            'date' => 'Date',
            'user_id' => 'User ID',
            'tickets_id' => 'Tickets ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasOne(Tickets::className(), ['id' => 'tickets_id']);
    }
}
