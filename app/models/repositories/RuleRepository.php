<?php

namespace app\models\repositories;

use app\models\RuleModel;

class RuleRepository
{
    public function getActiveRulesOrderedByPriority(): array
    {
        return RuleModel::find()
            ->where(['is_active' => true])
            ->orderBy('priority ASC')
            ->all();
    }
}