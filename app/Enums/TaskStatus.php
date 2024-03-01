<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'todo';

    case IN_PROGRESS = 'in_progress';

    case COMPLETED = 'completed';

    public static function values(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
