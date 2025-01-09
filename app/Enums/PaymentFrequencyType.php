<?php

namespace App\Enums;

enum PaymentFrequencyType: int
{
    case weekly = 0;
    case biweekly = 1;
    case monthly = 2;

    public function description(): string
    {
        return match ($this) {
            self::weekly => 'Weekly',
            self::biweekly => 'Biweekly',
            self::monthly => 'Monthly',
        };
    }

    public static function toArray(): array
    {
        return [
            self::weekly->value => self::weekly->description(),
            self::biweekly->value => self::biweekly->description(),
            self::monthly->value => self::monthly->description(),
        ];
    }

    public static function toArrayValues(): array
    {
        return [
            self::weekly->value,
            self::biweekly->value,
            self::monthly->value,
        ];
    }
}
