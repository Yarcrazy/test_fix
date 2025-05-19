<?php

namespace app\models\services;

use app\models\forms\BonusForm;
use app\models\RuleModel;
use app\models\AbstractRule;
use app\models\responses\BonusServiceResponse;
use app\models\RuleFactory;

class BonusService
{
    public function getBonusInfo(BonusForm $bonusForm): array
    {
        $totalBonus = 0;
        $appliedRules = [];
        foreach ($this->getRules() as $ruleModel) {
            /**
             * @var RuleModel $ruleModel
             * @var AbstractRule $rule
             */
            $rule = RuleFactory::create($ruleModel, $bonusForm);

            $resultFromRule = $rule->applyRule();
            if (!empty($resultFromRule)) {
                $totalBonus += $resultFromRule['bonus'];
                $bonusForm->transaction_amount = $totalBonus;
                $appliedRules[] = $resultFromRule;
            }
        }
        return (new BonusServiceResponse($totalBonus, $appliedRules))->toArray();
    }

    private function getRules(): array
    {
        return RuleModel::find()
            ->where(['is_active' => true])
            ->orderBy('priority ASC')
            ->all();
    }
}