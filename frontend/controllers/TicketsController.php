<?php

namespace frontend\controllers;

class TicketsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
