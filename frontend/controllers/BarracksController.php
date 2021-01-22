<?php

namespace frontend\controllers;

use app\models\Barracks;
use app\models\DefenceForces;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class BarracksController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               // 'only' => ['logout', 'signup','about'],// ha ez nincs bebbe akkor minden actionre szűrni fog
                'rules' => [
                  
                    [
                        'actions' => ['index','add','list','delete'],//csak user//
                        'allow' => true,
                        'roles' => ['@'],//bejelentkezett felfasználó//
                    ],
                ],
            ],
            
        ];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $barrack=new Barracks();

        $item = DefenceForces::find()->all();

        $items=[];

        foreach($item as  $defence_force){
            
            $items[$defence_force->id]=$defence_force->location;
        }

        

        if(Yii::$app->request->post()&& $barrack->load(Yii::$app->request->post())){
            $barrack->save();
            $barrack= new Barracks();
        }



        return $this->render('add',['barrack' => $barrack,'items'=>$items]);
    }
    public function actionList()
    {
        $list =Barracks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);






        return $this->render('list', ['list' => $dataProvider]);
    }

   public function actionDelete(){

    $request=Yii::$app->request->post('delete_id');
    
    $model=Barracks::find()->where(['id'=>$request])->one();
    //Barracks::deleteAll()
    if(isset($model)){
        $model->delete();


 
       //$model->save();
    }

return $this->redirect(['barracks/list']);
   }

   public function actionUpdate(){

    $request=Yii::$app->request->post('update_id');
    
    $model=Barracks::find()->where(['id'=>$request])->one();
    
    if(isset($model)){
     


       $model->name='';
       $model->save();
    }

return $this->redirect(['barracks/list']);
   }

}
