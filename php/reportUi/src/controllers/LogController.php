<?php

namespace app\controllers;

use app\models\search\LogSearch;
use Yii;
use yii\web\Controller;

class LogController extends Controller
{
    public function actionIndex(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
