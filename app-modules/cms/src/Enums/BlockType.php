<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Enums;

enum BlockType: string
{
    case Hero = 'hero';
    case Text = 'text';
    case CTA = 'cta';
    case Form = 'form';
    case Features = 'features';
    case Testimonials = 'testimonials';
    case Logos = 'logos';
    case Image = 'image';
    case Anchors = 'anchors';
    case Divider = 'divider';
    case Footer = 'footer';

    public static function options(): array
    {
        return [
            self::Hero->value => self::Hero->label(),
            self::Text->value => self::Text->label(),
            self::CTA->value => self::CTA->label(),
            self::Form->value => self::Form->label(),
            self::Features->value => self::Features->label(),
            self::Testimonials->value => self::Testimonials->label(),
            self::Logos->value => self::Logos->label(),
            self::Image->value => self::Image->label(),
            self::Anchors->value => self::Anchors->label(),
            self::Divider->value => self::Divider->label(),
            self::Footer->value => self::Footer->label(),
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::Hero => 'Hero',
            self::Text => 'Texto',
            self::CTA => 'Call to Action',
            self::Form => 'Formulário',
            self::Features => 'Recursos',
            self::Testimonials => 'Depoimentos',
            self::Logos => 'Logos',
            self::Image => 'Imagem',
            self::Anchors => 'Âncoras',
            self::Divider => 'Divisor',
            self::Footer => 'Rodapé',
        };
    }
}
