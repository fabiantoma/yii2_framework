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


}
