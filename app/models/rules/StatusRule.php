<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\responses\RuleResponse;

class StatusRule extends AbstractRule
{
    public function applyRule(): array
    {
        return in_array(
            $this->bonusForm->customer_status,
            $this->ruleModel->conditions['customer_statuses']
        )
            ? (new RuleResponse(
                    $this->ruleModel->name,
                    $this->bonusForm->transaction_amount * $this->ruleModel->conditions['bonus']
                ))->toArray()
            : [];
    }
}