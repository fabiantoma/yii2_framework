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

      /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['title', 'description', 'date', 'user_id'], 'required'],
            [['is_open', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['imageFile'], 'file'],
            [['picture'],'file'],
            [['title', 'description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if(!file_exists ('uploads')){
                mkdir('uploads');
            }
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        } else {
            return false;
        }
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

    public function getImageurl()
    {
    return \Yii::$app->request->BaseUrl.'/@web/uploads/'.$this->logo;
    }

}
