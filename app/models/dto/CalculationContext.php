<?php

namespace app\models\dto;

readonly class CalculationContext
{
    public function __construct(
        public float $transactionAmount,
        public string $timestamp,
        public string $customerStatus
    ) {}
}