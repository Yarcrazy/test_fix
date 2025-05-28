<?php

namespace tests\unit\models;

use app\models\RuleFactory;
use app\models\RuleModel;
use app\models\rules\UnknownRule;
use app\models\RuleTypeModel;
use app\models\rules\BaseRule;
use app\models\rules\StatusRule;
use app\models\rules\DaysOfWeekRule;

class RuleFactoryTest extends \Codeception\Test\Unit
{
    public function testCreateBaseRule()
    {
        $model = new RuleModel(['rule_type_id' => RuleTypeModel::BASE]);
        $rule = RuleFactory::create($model);
        $this->assertInstanceOf(BaseRule::class, $rule);
    }

    public function testCreateStatusRule()
    {
        $model = new RuleModel(['rule_type_id' => RuleTypeModel::STATUS_RELATION]);
        $rule = RuleFactory::create($model);
        $this->assertInstanceOf(StatusRule::class, $rule);
    }

    public function testCreateDaysOfWeekRule()
    {
        $model = new RuleModel(['rule_type_id' => RuleTypeModel::DAYS_OF_WEEK_RELATION]);
        $rule = RuleFactory::create($model);
        $this->assertInstanceOf(DaysOfWeekRule::class, $rule);
    }

    public function testCreateUnknownRule()
    {
        $model = new RuleModel(['rule_type_id' => 999]);
        $rule = RuleFactory::create($model);
        $this->assertInstanceOf(UnknownRule::class, $rule);
    }
}