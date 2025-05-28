<?php

namespace app\models\responses;

readonly class RuleResponse
{
    public function __construct(
        public string $rule = '',
        public float $bonus = 0
    ) {}

    public function toArray(): array
    {
        return [
            'rule' => $this->rule,
            'bonus' => $this->bonus,
        ];
    }
}