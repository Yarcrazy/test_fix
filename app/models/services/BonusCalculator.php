<?php

namespace app\models\services;

use app\models\dto\CalculationContext;
use app\models\responses\BonusResponse;
use app\models\repositories\RuleRepository;
use app\models\RuleFactory;

class BonusCalculator
{
    public function __construct(
        private RuleRepository $ruleRepository
    ) {}

    public function calculate(CalculationContext $context): BonusResponse
    {
        $rules = $this->ruleRepository->getActiveRulesOrderedByPriority();
        $appliedRules = [];
        $totalBonus = 0;

        foreach ($rules as $ruleModel) {
            $rule = RuleFactory::create($ruleModel);
            $response = $rule->applyRule($totalBonus, $context);

            if ($response->rule !== '') {
                $appliedRules[] = $response->toArray();
                $totalBonus += $response->bonus;
            }
        }

        return new BonusResponse($totalBonus, $appliedRules);
    }
}