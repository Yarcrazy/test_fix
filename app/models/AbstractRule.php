<?php

namespace app\models;

use app\models\interfaces\RuleInterface;

abstract class AbstractRule implements RuleInterface
{
    public RuleModel $ruleModel;
    public function __construct(RuleModel $ruleModel)
    {
        $this->ruleModel = $ruleModel;
    }
}