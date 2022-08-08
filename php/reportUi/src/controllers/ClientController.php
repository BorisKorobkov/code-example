<?php

namespace app\controllers;

use app\models\search\ClientSearch;
use Yii;
use yii\web\Controller;

class ClientController extends Controller
{
    public function actionIndex(): string
    {
        $queryParams = Yii::$app->request->queryParams;
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search($queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
