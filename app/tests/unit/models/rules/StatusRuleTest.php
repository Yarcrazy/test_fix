<?php

namespace tests\unit\models\rules;

use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;
use app\models\RuleModel;
use app\models\rules\BaseRule;
use app\models\rules\StatusRule;

class StatusRuleTest extends \Codeception\Test\Unit
{
    public function testApplyRule()
    {
        $ruleModel = new RuleModel([
            'name' => 'Test Rule',
            'conditions' => ['bonus' => 0.2, 'customer_statuses' => ['vip']],
        ]);

        $rule = new StatusRule($ruleModel);
        $context = new CalculationContext(100.0, '2025-01-01T00:00:00Z', 'vip');
        $response = $rule->applyRule(100.0, $context);

        $this->assertEquals(20.0, $response->bonus);
    }

    public function testNotApplyRule()
    {
        $ruleModel = new RuleModel([
            'name' => 'Test Rule',
            'conditions' => ['bonus' => 0.2, 'customer_statuses' => ['vip']],
        ]);

        $rule = new StatusRule($ruleModel);
        $context = new CalculationContext(100.0, '2025-01-01T00:00:00Z', 'regular');
        $response = $rule->applyRule(100.0, $context);

        $this->assertEquals(0, $response->bonus);
        $this->assertEquals('', $response->rule);
    }
}