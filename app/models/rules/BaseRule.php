<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;

class BaseRule extends AbstractRule
{
    public function applyRule(float $amount, CalculationContext $context): RuleResponse
    {
        return new RuleResponse(
            $this->ruleModel->name,
            $context->transactionAmount * $this->ruleModel->conditions['bonus']
        );
    }
}