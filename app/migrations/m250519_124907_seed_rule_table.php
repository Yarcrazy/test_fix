<?php

use app\enums\Customer;
use app\models\RuleModel;
use app\models\RuleTypeModel;
use yii\db\Migration;

class m250519_124907_seed_rule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавляем базовые правила
        $this->batchInsert(RuleModel::tableName(),
            ['name', 'rule_type_id', 'description', 'conditions', 'priority'],
            [
                [
                    'name' => 'base_rate',
                    'rule_type_id' => RuleTypeModel::BASE,
                    'description' => '1 бонус за каждые $10',
                    'conditions' => json_encode([
                        'bonus' => 0.1
                    ]),
                    'priority' => 0,
                ],
                [
                    'name' => 'holiday_bonus',
                    'rule_type_id' => RuleTypeModel::DAYS_OF_WEEK_RELATION,
                    'description' => 'Удвоение бонусов в выходные',
                    'conditions' => json_encode([
                        'bonus' => 1,
                        'days_of_week' => [6, 7],
                    ]),
                    'priority' => 1,
                ],
                [
                    'name' => 'vip_boost',
                    'rule_type_id' => RuleTypeModel::STATUS_RELATION,
                    'description' => 'Дополнительные 40% бонусов для VIP',
                    'conditions' => json_encode([
                        'bonus' => 0.4,
                        'customer_statuses' => [Customer::VIP_STATUS->value]
                    ]),
                    'priority' => 2,
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
