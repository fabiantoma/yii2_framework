<?php
namespace backend\controllers;

use app\models\Tickets;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','list-tickets','assign'],
                        'allow' => true,
                        'roles' => ['@'],//bejelentkezett
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionListTickets(){


        $list=Tickets::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $list,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('list', ['list' => $dataProvider]);
    }

    public function actionAssign(){
        $id=Yii::$app->request->get('id');
        $ticket=Tickets::find()->where(['id'=>$id])->one();
        $ticket->admin_id=  Yii::$app->user->id;
        $ticket->save();

        return $this->redirect(['site/list-tickets']);

    }
    public function actionClose(){
        $id=Yii::$app->request->get('id');
        $ticket=Tickets::find()->where(['id'=>$id])->one();

        if(isset($ticket)){
     
            $ticket->is_open=false;
          
            $ticket->save();
         }

        return $this->redirect(['site/list-tickets']);

    }
}
//megírni 