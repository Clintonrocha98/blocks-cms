<?php

namespace App\Enums;

enum BlockType: string
{
    case Hero = 'hero';
    case Text = 'text';
    case CTA = 'cta';

    public function label(): string
    {
        return match ($this) {
            self::Hero => 'Hero',
            self::Text => 'Texto',
            self::CTA => 'Call to Action',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => ucfirst($case->value),
            ])
            ->toArray();
    }
}
