<?php

namespace app\models\interfaces;

use app\models\dto\CalculationContext;
use app\models\responses\RuleResponse;

interface RuleInterface
{
    public function applyRule(float $amount, CalculationContext $context): RuleResponse;
}