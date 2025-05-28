<?php

namespace app\models\forms;

use app\enums\Customer;
use app\models\dto\CalculationContext;
use yii\base\Model;

class BonusForm extends Model
{
    public $transaction_amount;
    public $timestamp;
    public $customer_status;

    const array STATUSES = [
        Customer::REGULAR_STATUS->value,
        Customer::VIP_STATUS->value,
    ];

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['transaction_amount', 'timestamp', 'customer_status'], 'required'],

            ['transaction_amount', 'number', 'min' => 1],

            ['transaction_amount', 'match', 'pattern' => '/^\d+(\.\d{1,2})?$/',
                'message' => 'Amount must have no more than 2 decimal places'],

            ['timestamp', 'datetime', 'format' => 'php:Y-m-d\TH:i:s\Z'],

            ['customer_status', 'in', 'range' => self::STATUSES],
        ];
    }

    public function toCalculationContext(): CalculationContext
    {
        return new CalculationContext(
            transactionAmount: $this->transaction_amount,
            timestamp: $this->timestamp,
            customerStatus: $this->customer_status
        );
    }
}