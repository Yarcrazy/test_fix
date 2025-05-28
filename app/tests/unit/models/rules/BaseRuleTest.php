<?php

namespace tests\unit\models\rules;

use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;
use app\models\RuleModel;
use app\models\rules\BaseRule;

class BaseRuleTest extends \Codeception\Test\Unit
{
    public function testApplyRule()
    {
        $ruleModel = new RuleModel([
            'name' => 'Test Rule',
            'conditions' => ['bonus' => 0.2],
        ]);

        $rule = new BaseRule($ruleModel);
        $context = new CalculationContext(100.0, '2025-01-01T00:00:00Z', 'vip');
        $response = $rule->applyRule(0, $context);

        $this->assertInstanceOf(RuleResponse::class, $response);
        $this->assertEquals(20.0, $response->bonus);
    }
}