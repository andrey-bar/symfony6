<?php

declare(strict_types=1);

namespace App\Helper;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;

class CurrencyHelper
{
    public function isSame(Money ...$amounts): bool
    {
        if (count($amounts) === 1) {
            return true;
        }

        $first = array_shift($amounts);

        return $first->isSameCurrency(...$amounts);
    }

    public function numericCode(Money $amount): int
    {
        return (new ISOCurrencies())->numericCodeFor($amount->getCurrency());
    }

    public function addValues(mixed $a, mixed $b): string
    {
        $moneyA = new Money($this->processValue($a), new Currency('RUB'));

        $moneyB = new Money($this->processValue($b), new Currency('RUB'));

        $moneyResult = $moneyA->add($moneyB);

        return $moneyResult->getAmount();
    }

    public function subtarctValues(Money $a, Money $b): Money
    {
        return $a->subtract($b);
    }

    private function processValue(int|float|string $value): int
    {
        if (is_int($value)) {
            return $value * 100;
        }

        return (int) ((float)$value * 100);
    }
}
