<?php

namespace app\controllers;

use app\models\search\UserSearch;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
