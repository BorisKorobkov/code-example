<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\ErrorAction;

class ErrorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
