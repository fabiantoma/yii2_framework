<?php

namespace frontend\controllers;

use app\models\Barracks;
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
        $barrack=new Barracks();

        if(Yii::$app->request->post()&& $barrack->load(Yii::$app->request->post())){
            $barrack->save();
            $barrack= new Barracks();
        }



        return $this->render('add',['barrack' => $barrack]);
    }
    public function actionList()
    {
        $list =Barracks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);




        return $this->render('list', ['list' => $dataProvider]);
    }

    

}
