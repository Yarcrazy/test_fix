<?php

namespace app\models\responses;

readonly class BonusResponse
{
    public function __construct(
        public float $totalBonus,
        public array $appliedRules
    ) {}

    public function toArray(): array
    {
        return [
            'total_bonus'   => $this->totalBonus,
            'applied_rules' => $this->appliedRules,
        ];
    }
}