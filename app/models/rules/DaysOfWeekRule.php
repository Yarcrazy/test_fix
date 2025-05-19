<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\responses\RuleResponse;

class DaysOfWeekRule extends AbstractRule
{
    public function applyRule(): array
    {
        return in_array(
            date('N', strtotime($this->bonusForm->timestamp)),
            $this->ruleModel->conditions['days_of_week']
        )
            ? (new RuleResponse(
                    $this->ruleModel->name,
                    $this->bonusForm->transaction_amount * $this->ruleModel->conditions['bonus']
                ))->toArray()
            : [];
    }
}