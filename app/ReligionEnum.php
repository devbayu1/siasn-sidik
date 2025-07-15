<?php

namespace App;

enum ReligionEnum: string
{
    case ISLAM = 'Islam';
    case KRISTEN = 'Kristen';
    case KATOLIK = 'Katolik';
    case KATHOLIK = 'Katholik';
    case HINDU = 'Hindu';
    case BUDDHA = 'Buddha';
    case KHONGHUCU = 'Khonghucu';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'value');
    }

    public static function fromString(string $value): self
    {
        return match (strtolower($value)) {
            'islam' => self::ISLAM,
            'kristen' => self::KRISTEN,
            'katolik' => self::KATOLIK,
            'katholik' => self::KATHOLIK,
            'hindu' => self::HINDU,
            'buddha' => self::BUDDHA,
            'khonghucu' => self::KHONGHUCU,
            default => throw new \InvalidArgumentException("Invalid religion: $value"),
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::ISLAM => 'Islam',
            self::KRISTEN => 'Kristen',
            self::KATOLIK => 'Katolik',
            self::KATHOLIK => 'Katholik',
            self::HINDU => 'Hindu',
            self::BUDDHA => 'Buddha',
            self::KHONGHUCU => 'Khonghucu',
        };
    }

    public function toString(): string
    {
        return $this->value;
    }
}
