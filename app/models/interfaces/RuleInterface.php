<?php

namespace app\models\interfaces;

interface RuleInterface
{
    public function applyRule(): array;
}