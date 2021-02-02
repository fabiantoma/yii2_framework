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
    public function upload(){
        //ha validálás lefut akkor és a uploads file létezik akkor létrehoz uploads mappa//
                if($this->validate()){
                    if(!file_exists('uploads')){
                        mkdir('uploads');
                }
                //elmenti a uploads mappába a megfelelő formátumba a fájlt//
                $this->imagefile->saveAs('uploads/' . $this->imagefile->baseName . '.' . $this->imageFile->extension);
                return 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                }else{
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
            'name' => 'Name',
            'number' => 'Number',
            'df_id' => 'Defence Forces',
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
