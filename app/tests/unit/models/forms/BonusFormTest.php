<?php

namespace tests\unit\models\forms;

use app\models\forms\BonusForm;

class BonusFormTest extends \Codeception\Test\Unit
{
    public function testValidationSuccess()
    {
        $form = new BonusForm([
            'transaction_amount' => 100.50,
            'timestamp' => '2025-03-08T14:30:00Z',
            'customer_status' => 'vip',
        ]);

        $this->assertTrue($form->validate());
    }

    public function testValidationFailed()
    {
        $form = new BonusForm([
            'transaction_amount' => -10,
            'timestamp' => 'invalid-date',
            'customer_status' => 'unknown',
        ]);

        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('transaction_amount', $form->errors);
        $this->assertArrayHasKey('timestamp', $form->errors);
        $this->assertArrayHasKey('customer_status', $form->errors);
    }

    public function testToCalculationContext()
    {
        $form = new BonusForm([
            'transaction_amount' => 150,
            'timestamp' => '2025-03-08T14:30:00Z',
            'customer_status' => 'regular',
        ]);

        $context = $form->toCalculationContext();
        $this->assertEquals(150.0, $context->transactionAmount);
        $this->assertEquals('regular', $context->customerStatus);
    }
}