<?php

namespace frontend\controllers;


use app\models\Tickets;
use app\models\User;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class TicketsController extends \yii\web\Controller
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
        $ticket = new Tickets();


        $item = User::find()->all();

        $items=[];

        foreach($item as  $user){
            
           $items[$user->id]=$user->title;
        }

        if(Yii::$app->request->post()&& $ticket->load(Yii::$app->request->post())){
            $ticket->save();
            
            $ticket= new Tickets();
        }




        return $this->render('add', ['ticket' => $ticket,'items'=>$items]);
    }
    public function actionList()
    {
        $list =Tickets::find();
        

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
        
        $model=Tickets::find()->where(['id'=>$request])->one();
        //Companies::deleteAll()
        if(isset($model)){
            $model->delete();
    
    
     
           //$model->save();
        }
    
    return $this->redirect(['tickets/list']);
       }
       public function actionUpdate(){
    
        $request=Yii::$app->request->post('update_id');
        
        $model=Tickets::find()->where(['id'=>$request])->one();
        
        if(isset($model)){
         
    
    
           $model->name='';
           $model->save();
        }
    
    return $this->redirect(['companies/list']);
       }
}
