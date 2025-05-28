<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;

class StatusRule extends AbstractRule
{
    public function applyRule(float $amount, CalculationContext $context): RuleResponse
    {
        return in_array(
            $context->customerStatus,
            $this->ruleModel->conditions['customer_statuses']
        )
            ? new RuleResponse(
                    $this->ruleModel->name,
                    $amount * $this->ruleModel->conditions['bonus']
                )
            : new RuleResponse();
    }
}