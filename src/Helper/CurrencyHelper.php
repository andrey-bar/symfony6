<?php

declare(strict_types=1);

namespace App\Helper;

use Money\Currencies\ISOCurrencies;
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

    public function addValues(Money $a, Money $b): Money
    {
        return $a->add($b);
    }

    public function subtarctValues(Money $a, Money $b): Money
    {
        return $a->subtract($b);
    }
}
