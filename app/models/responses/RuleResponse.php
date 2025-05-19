<?php

namespace app\models\responses;

class RuleResponse
{
    private string $rule;
    private float $bonus;

    public function __construct($rule, $bonus)
    {
        $this->rule = $rule;
        $this->bonus = $bonus;
    }

    public function toArray(): array
    {
        return [
            'rule' => $this->rule,
            'bonus' => round($this->bonus, 2),
        ];
    }
}