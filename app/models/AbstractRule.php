<?php

namespace app\models;

use app\models\forms\BonusForm;
use app\models\RuleModel;
use app\models\interfaces\RuleInterface;
use app\models\responses\RuleResponse;

abstract class AbstractRule implements RuleInterface
{
    public RuleModel $ruleModel;
    public BonusForm $bonusForm;
    public function __construct(RuleModel $ruleModel, BonusForm $bonusForm) {
        $this->ruleModel = $ruleModel;
        $this->bonusForm = $bonusForm;
    }
    public function applyRule(): array
    {
        return [];
    }
}