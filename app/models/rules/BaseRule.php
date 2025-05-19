<?php

namespace app\models\rules;

use app\models\AbstractRule;
use app\models\responses\RuleResponse;

class BaseRule extends AbstractRule
{
    public function applyRule(): array
    {
        return (new RuleResponse(
            $this->ruleModel->name,
            $this->bonusForm->transaction_amount * $this->ruleModel->conditions['bonus']
        ))->toArray();
    }
}