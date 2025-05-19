<?php

use app\models\RuleModel;
use yii\db\Migration;

class m250518_184616_create_table_rules extends Migration
{
    public function safeUp()
    {
        $this->createTable(RuleModel::tableName(), [
            'id' => $this->primaryKey(),
            'rule_type_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'conditions' => $this->json()->comment('Условия применения правила'),
            'priority' => $this->integer()->notNull(),
            'is_active' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Добавляем индексы для оптимизации
        $this->createIndex(
            'idx-rules-priority',
            RuleModel::tableName(),
            'priority'
        );

        $this->createIndex(
            'idx-rules-is_active',
            RuleModel::tableName(),
            'is_active'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(RuleModel::tableName());
    }
}
