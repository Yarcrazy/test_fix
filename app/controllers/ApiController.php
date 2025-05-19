<?php

namespace app\controllers;

use app\models\forms\BonusForm;
use app\models\services\BonusService;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    private BonusService $bonusService;

    public function __construct($id, $module, $config)
    {
        $this->bonusService = new BonusService();
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'calculate'  => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionCalculate()
    {
        $model = new BonusForm();
        $model->load(Yii::$app->request->post(), '');
        if (!$model->validate()) {
            Yii::$app->response->statusCode = 422;
            return ['errors' => $model->errors];
        }

        return $this->bonusService->getBonusInfo($model);
    }
}