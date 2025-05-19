<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rules".
 *
 * @property int $id
 * @property int $rule_type_id
 * @property string $name
 * @property string|null $description
 * @property string|null $conditions Условия применения правила
 * @property int $priority
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property RuleTypeModel $ruleType
 */
class RuleModel extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'conditions'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['rule_type_id', 'name', 'priority'], 'required'],
            [['rule_type_id', 'priority'], 'default', 'value' => null],
            [['rule_type_id', 'priority'], 'integer'],
            [['description'], 'string'],
            [['conditions', 'created_at', 'updated_at'], 'safe'],
            [['is_active'], 'boolean'],
            [['name'], 'string', 'max' => 100],
            [['rule_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RuleTypeModel::class, 'targetAttribute' => ['rule_type_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d\TH:i:s\Z'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rule_type_id' => 'Rule Type ID',
            'name' => 'Name',
            'description' => 'Description',
            'conditions' => 'Conditions',
            'priority' => 'Priority',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RuleTypeModel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRuleType()
    {
        return $this->hasOne(RuleTypeModel::class, ['id' => 'rule_type_id']);
    }

}
