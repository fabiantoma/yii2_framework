<?php

namespace frontend\controllers;


use app\models\Tasks;
use yii\filters\AccessControl;
use Yii;

use yii\data\ActiveDataProvider;

class TasksController extends \yii\web\Controller
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
        $task = new Tasks();

        if(Yii::$app->request->post()&& $task->load(Yii::$app->request->post())){
            $task->save();
            $task= new Tasks();
        }




        return $this->render('add', ['task' => $task]);
    }
    public function actionList()
    {
        $list =Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);




        return $this->render('list', ['list' => $dataProvider]);
    }
}
