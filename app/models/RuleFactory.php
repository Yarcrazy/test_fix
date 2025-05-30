<?php

namespace app\models;

use app\models\rules\BaseRule;
use app\models\rules\DaysOfWeekRule;
use app\models\rules\StatusRule;
use app\models\rules\UnknownRule;

class RuleFactory
{
    public static function create(RuleModel $ruleModel): AbstractRule {
        $class = match ($ruleModel->rule_type_id) {
            RuleTypeModel::BASE                     => BaseRule::class,
            RuleTypeModel::STATUS_RELATION          => StatusRule::class,
            RuleTypeModel::DAYS_OF_WEEK_RELATION    => DaysOfWeekRule::class,
            default                                 => UnknownRule::class,
        };
        return new $class($ruleModel);
    }
}