<?php

use app\models\RuleModel;
use app\models\RuleTypeModel;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%rule_types}}`.
 */
class m250519_120619_create_rule_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(RuleTypeModel::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
        ]);

        $this->batchInsert(RuleTypeModel::tableName(),
            ['name', 'description'],
            [
                [
                    'name' => 'base',
                    'description' => 'Базовое правило, применяется всегда'
                ],
                [
                    'name' => 'status_relation',
                    'description' => 'Правило, зависящее от статуса клиента'
                ],
                [
                    'name' => 'days_of_week_relation',
                    'description' => 'Правило, зависящее от дней недели'
                ]
            ]
        );

        $this->addForeignKey('fk_rules_rule_types', RuleModel::tableName(), 'rule_type_id', RuleTypeModel::tableName(), 'id');

        $this->createIndex(
            'idx-rule_types-name',
            RuleTypeModel::tableName(),
            'name',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_rules_rule_types', RuleModel::tableName());
        $this->dropTable(RuleTypeModel::tableName());
    }
}
