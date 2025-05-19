<?php

namespace app\models\responses;

class BonusServiceResponse
{
    private float $totalBonus;
    private array $appliedRules;

    public function __construct($totalBonus, $appliedRules)
    {
        $this->totalBonus   = $totalBonus;
        $this->appliedRules = $appliedRules;
    }

    public function toArray(): array
    {
        return [
            'total_bonus'   => $this->totalBonus,
            'applied_rules' => $this->appliedRules,
        ];
    }
}