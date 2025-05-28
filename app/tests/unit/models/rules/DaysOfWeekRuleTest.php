<?php

namespace tests\unit\models\rules;

use app\models\dto\CalculationContext;
use app\models\RuleModel;
use app\models\rules\DaysOfWeekRule;

class DaysOfWeekRuleTest extends \Codeception\Test\Unit
{
    public function testApplyRule()
    {
        $ruleModel = new RuleModel([
            'name' => 'Test Rule',
            'conditions' => ['bonus' => 0.2, 'days_of_week' => [6, 7]],
        ]);

        $rule = new DaysOfWeekRule($ruleModel);
        $context = new CalculationContext(100.0, '2025-05-04T00:00:00Z', 'vip');
        $response = $rule->applyRule(100.0, $context);

        $this->assertEquals(20.0, $response->bonus);
    }

    public function testNotApplyRule()
    {
        $ruleModel = new RuleModel([
            'name' => 'Test Rule',
            'conditions' => ['bonus' => 0.2, 'days_of_week' => [6, 7]],
        ]);

        $rule = new DaysOfWeekRule($ruleModel);
        $context = new CalculationContext(100.0, '2025-04-30T00:00:00Z', 'vip');
        $response = $rule->applyRule(100.0, $context);

        $this->assertEquals(0, $response->bonus);
        $this->assertEquals('', $response->rule);
    }
}