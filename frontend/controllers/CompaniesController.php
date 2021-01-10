<?php

namespace frontend\controllers;

use app\models\Companies;
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

        if(Yii::$app->request->post()&& $company->load(Yii::$app->request->post())){
            $company->save();
            
            $company= new Companies();
        }




        return $this->render('add', ['company' => $company]);
    }
    public function actionList()
    {
        $list =Companies::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);




        return $this->render('list', ['list' => $dataProvider]);
    }


}
