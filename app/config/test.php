<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => $db,
    ],
    'container' => [
        'definitions' => [
            // Регистрируем зависимости
            \app\models\repositories\RuleRepository::class => \app\models\repositories\RuleRepository::class,
            \app\models\services\BonusCalculator::class => function ($container) {
                return new \app\models\services\BonusCalculator(
                    $container->get(\app\models\repositories\RuleRepository::class)
                );
            },
        ],
        'singletons' => [
            // Можно добавить синглтоны при необходимости
        ],
    ],
    'params' => $params,
];