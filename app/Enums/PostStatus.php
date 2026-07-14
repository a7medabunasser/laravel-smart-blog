<?php

namespace App\Enums;

enum PostStatus: string
{
    case Published = 'Published';
    case Draft = 'Draft';
    case Archived = 'Archived';

    public function getLabel(): string
    {
        return match ($this) {
            self::Published => 'Published',
            self::Draft => 'Draft',
            self::Archived => 'Archived',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Published => 'text-green-600 border-green-600',
            self::Draft => 'text-stone-800 border-stone-800',
            self::Archived => 'text-red-600 border-red-600',
        };
    }

    public function getBadgeColor(): string
    {
        return match ($this) {
            self::Published => 'bg-green-50 text-green-700 border-green-200',
            self::Draft => 'bg-stone-50 text-stone-700 border-stone-200',
            self::Archived => 'bg-red-50 text-red-700 border-red-200',
        };
    }

    public function getDotColor(): string
    {
        return match ($this) {
            self::Published => 'bg-green-600',
            self::Draft => 'bg-stone-600',
            self::Archived => 'bg-red-600',
        };
    }
}
