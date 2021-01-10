<?php

namespace frontend\controllers;


use app\models\DefenceForces;
use app\models\Soldiers;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class SoldiersController extends \yii\web\Controller
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
        $soldier = new Soldiers();

        if(Yii::$app->request->post()&& $soldier->load(Yii::$app->request->post())){
            $soldier->save();
            $soldier= new Soldiers();
        }




        return $this->render('add', ['soldier' => $soldier]);
    }
    public function actionList()
    {
        $list =Soldiers::find()->where(['>','id',0]);//nagyobb az id-ja 1-nél//

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);




        return $this->render('list', ['list' => $dataProvider]);
    }

}
