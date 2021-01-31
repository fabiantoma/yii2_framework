<?php

namespace frontend\controllers;



use app\models\Companies;
use app\models\Barracks;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class CompaniesController extends \yii\web\Controller
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
        $company = new Companies();


        $item = Barracks::find()->all();

        $items=[];

        foreach($item as  $bk){
            
           $items[$bk->id]=$bk->name;
        }

        if(Yii::$app->request->post()&& $company->load(Yii::$app->request->post())){
            $company->save();
            
            $company= new Companies();
        }

        return $this->render('add', ['company' => $company,'items'=>$items]);
    }
    
    public function actionList()
    {
        $list =Companies::find();
        

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
        
        $model=Companies::find()->where(['id'=>$request])->one();
        //Companies::deleteAll()
        if(isset($model)){
            $model->delete();
    
    
     
           //$model->save();
        }
    
    return $this->redirect(['companies/list']);
       }
    
       public function actionUpdate(){
    
        $request=Yii::$app->request->post('update_id');
        
        $model=Companies::find()->where(['id'=>$request])->one();
        
        if(isset($model)){
         
    
    
           $model->name='';
           $model->save();
        }
    
    return $this->redirect(['companies/list']);
       }

}
