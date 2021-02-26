<?php

namespace frontend\controllers;


use app\models\Tickets;
use common\models\User;
use yii\filters\AccessControl;
use Yii;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\models\Comments;


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
                        'actions' => ['index','add','list','delete','view','update'],//csak user//
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

        if(Yii::$app->request->post()&& $ticket->load(Yii::$app->request->post())){
           //mahuálisan beállított értékek amit a reuestben nincsenek beenne//
            $ticket->date=date("Y-m-d H:i:s");
            $ticket->user_id = Yii::$app->user->id;
            //kép feltöltés értkeinek meghatározása//
            $ticket->imageFile = UploadedFile::getInstance($ticket, 'imageFile');
            $p=$ticket->upload();

            if ( $p!=false) {
              $ticket->picture=$p;  // file is uploaded successfully
            }
            $ticket->validate();
            if ($ticket->validate()==true&& $ticket->save()==true){
                $ticket= new Tickets();
            }
        }
        return $this->render('add', ['ticket' => $ticket,]);
    }


    public function actionList()
    {
        $list =Tickets::find()->andWhere(['user_id' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('list', ['list' => $dataProvider]);
    }

    public function actionView()

    {
        $ticket = new Tickets();
        $comment= new Comments;
        $request=Yii::$app->request->get('id');

        if(Yii::$app->request->post()&& $comment->load(Yii::$app->request->post())){
           
            $comment->date=date("Y-m-d H:i:s");
            $comment->user_id = Yii::$app->user->id;
            $comment->tickets_id = $request;
              
        
            if ($comment->validate()==true&& $comment->save()==true){
                $comment= new Comments();
            }
        }
       
        $ticket= new Tickets();

        if(isset($request)){
            $ticket = Tickets::find()->where(['id'=>$request])->andWhere(['user_id'=>Yii::$app->user->id])->one();;
            $comments= Comments::find()->where(['tickets_id'=>$ticket->id])->all();
    
        }
        
        return $this->render('view', ['ticket' =>$ticket ,'comment'=>$comment ,'comments'=> $comments]);
    }


//actionView(){   } id alapján lekérdezni a ticketet,csak a saját userhez szabad,andwhere feltétel
//lekérdezni az ehhez a tickethez tartozó kommenteket,comments->find()->where ticket id =a visszakapott ticket-nek az idjaval
//átadni a viewnak és aforech-el kilistázni 



    public function actionDelete(){

        $request=Yii::$app->request->get('id');
        
        $model=Tickets::find()->where(['id'=>$request])->andWhere(['user_id'=>Yii::$app->user->id])->one();
        // kigyűjtjük az összes hibajegyeket ahol az id az az ehhez való user id,majd hozzárendeljük a one függvényt//
        if(isset($model)){
            //ha létezik ez akkor törli//
            $model->delete();
          
        }
    
    return $this->redirect(['tickets/list']);


    
       }
       public function actionUpdate(){
    
        $request=Yii::$app->request->post('update_id');
        
        $model=Tickets::find()->where(['id'=>$request])->one();
        
        if(isset($model)){
         
    
    $request=Yii::$app->request->get('update_id');
    
    $model=Tickets::find()->where(['id'=>$request])->andWhere(['user_id'=>Yii::$app->user->id])->one();
    
    if(isset($model)){
     
       //$model->is_open=false;
     
       $model->save();
    }

    return $this->redirect(['tickets/list']);
}

}
