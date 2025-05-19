<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule_types".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property RuleModel[] $rules
 */
class RuleTypeModel extends \yii\db\ActiveRecord
{
    const BASE = 1;
    const STATUS_RELATION = 2;
    const DAYS_OF_WEEK_RELATION = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[RuleModel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(RuleModel::class, ['rule_type_id' => 'id']);
    }

}
