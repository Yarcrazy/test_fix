<?php

namespace tests\unit\models\services;

use app\models\dto\CalculationContext;
use app\models\responses\BonusResponse;
use app\models\RuleModel;
use app\models\services\BonusCalculator;

class BonusCalculatorTest extends \Codeception\Test\Unit
{
    public function testCalculateWithRules()
    {
        // Создаем mock для RuleRepository
        $ruleRepo = $this->makeEmpty(\app\models\repositories\RuleRepository::class, [
            'getActiveRulesOrderedByPriority' => [
                new RuleModel([
                    'rule_type_id' => 1,
                    'conditions' => ['bonus' => 0.1],
                    'name' => 'Base Rule',
                ]),
            ],
        ]);

        $calculator = new BonusCalculator($ruleRepo);
        $context = new CalculationContext(100.0, '2025-01-01T00:00:00Z', 'vip');

        $response = $calculator->calculate($context);

        $this->assertInstanceOf(BonusResponse::class, $response);
        $this->assertEquals(10.0, $response->totalBonus);
        $this->assertCount(1, $response->appliedRules);
    }
}