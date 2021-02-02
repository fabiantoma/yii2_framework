<?php

namespace frontend\controllers;

use app\models\DefenceForces;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class DefenceForcesController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               // 'only' => ['logout', 'signup','about'],// ha ez nincs bebbe akkor minden actionre szűrni fog
                'rules' => [
                  
                    [
                        'actions' => ['index','add','list'],//csak user//
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
        $df = new DefenceForces();

        if(Yii::$app->request->post()&& $df->load(Yii::$app->request->post())){
            $df->save();
            $df= new DefenceForces();
        }




        return $this->render('add', ['df' => $df]);
    }
    public function actionList()
    {
        $list =DefenceForces::find()->where(['>','id',1]);//nagyobb az id-ja 1-nél//

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
        
        $model=DefenceForces::find()->where(['id'=>$request])->one();
        //DefenceForces::deleteAll()
        if(isset($model)){
            $model->delete();
    
    
     
           //$model->save();
        }
    
    return $this->redirect(['defence-forces/list']);
       }
    
       public function actionUpdate(){
    
        $request=Yii::$app->request->post('update_id');
        
        $model=DefenceForces::find()->where(['id'=>$request])->one();
        
        if(isset($model)){
         
    
    
           $model->name='';
           $model->save();
        }
    
    return $this->redirect(['defence-forces/list']);
       }
}
