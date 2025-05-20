<?php

namespace app\controllers;

use app\models\forms\BonusForm;
use app\models\services\BonusService;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Bonus Calculation API",
    description: "API для расчета бонусов клиентов",
)]
#[OA\Server(url: "http://localhost:9234")]

class BonusController extends Controller
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
                    'calculate' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    #[OA\Post(
        path: '/calculate-bonus',
        tags: ['Bonus'],
        summary: 'Calculate transaction bonus',
        operationId: 'calculateBonus'
    )]
    #[OA\RequestBody(
        description: "Transaction data",
        required: true,
        content: new OA\JsonContent(
            required: ['transaction_amount', 'timestamp', 'customer_status'],
            properties: [
                new OA\Property(property: "transaction_amount", type: "number", format: "float", example: 150.05),
                new OA\Property(property: "timestamp", type: "string", format: "date-time", example: "2025-03-08T14:30:00Z"),
                new OA\Property(property: "customer_status", type: "string", enum: ["regular", "vip"], example: "vip")
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Successful calculation",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "total_bonus", type: "integer", example: 42),
                new OA\Property(
                    property: "applied_rules",
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "rule", type: "string", example: "base_rate"),
                            new OA\Property(property: "bonus", type: "integer", example: 15)
                        ],
                        type: "object"
                    )
                )
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: "Validation error"
    )]
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