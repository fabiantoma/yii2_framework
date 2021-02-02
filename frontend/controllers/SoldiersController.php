<?php

namespace frontend\controllers;


use app\models\DefenceForces;
use app\models\Companies;
use app\models\Tasks;
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

        $item = Companies::find()->all();

        $items=[];

        foreach($item as  $sold){
            
           $items[$sold->id]=$sold->name;
        }


        $task_item = Tasks::find()->all();

        $tasks_items=[];

        foreach($task_item as  $tk){
            
           $tasks_items[$tk->id]=$tk->name;
        }

        if(Yii::$app->request->post()&& $soldier->load(Yii::$app->request->post())){
            $soldier->save();
            $soldier= new Soldiers();
        }




        return $this->render('add', ['soldier' => $soldier,'items'=>$items,'tasks_items'=>$tasks_items]);
    }
    public function actionList()
    {
        $list =Soldiers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);




        return $this->render('list', ['list' => $dataProvider]);
    }

}
