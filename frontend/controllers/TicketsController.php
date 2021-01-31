<?php

namespace frontend\controllers;


use app\models\Tickets;
use common\models\User;
use yii\filters\AccessControl;
use Yii;
use app\models\UploadForm;
use yii\web\UploadedFile;
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
                        'actions' => ['index','add','list','delete','ticket_view'],//csak user//
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
           
            $ticket->date=date("Y-m-d H:i:s");
            $ticket->user_id = Yii::$app->user->id;
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

       
        $item =Tickets::find()->andWhere(['user_id' => Yii::$app->user->id] && $ticket->description);

        //$comment->find()->andWhere(['user_id' => Yii::$app->user->id]);
        //$ticket->comments=$ticket->dicriptions//

        $items=[];

        foreach($item as  $comment){
            
           $items[$comment->id]=$comment->name;
        }
        
        return $this->render('list', ['ticket' =>$ticket ,'items'=>$items]);
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
         
    
    
           $model->name='';
           $model->save();
        }
    
    return $this->redirect(['tickets/list']);
       }
}
