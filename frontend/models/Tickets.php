<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $picture
 * @property int|null $is_open
 * @property string $date
 * @property int $user_id
 *
 * @property Comments[] $comments
 * @property User $user
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date', 'user_id'], 'required'],
            [['is_open', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['title', 'description', 'picture'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'description' => 'Description',
            'picture' => 'Picture',
            'is_open' => 'Is Open',
            'date' => 'Date',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['tickets_id' => 'id']);
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
}
