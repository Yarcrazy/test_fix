<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;

class DaysOfWeekRule extends AbstractRule
{
    public function applyRule(float $amount, CalculationContext $context): RuleResponse
    {
        return in_array(
            date('N', strtotime($context->timestamp)),
            $this->ruleModel->conditions['days_of_week']
        )
            ? new RuleResponse(
                $this->ruleModel->name,
                round($amount * $this->ruleModel->conditions['bonus'], 2)
            )
            : new RuleResponse();
    }
}