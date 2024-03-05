<?php

namespace App\Enums;

/**
 * Task status enum.
 */
enum TaskStatus: string
{
    /**
     * Task status - todo
     */
    case TODO = 'todo';

    /**
     * Task status - in progress
     */
    case IN_PROGRESS = 'in_progress';

    /**
     * Task status - completed
     */
    case COMPLETED = 'completed';

    /**
     * Get all task status values
     */
    public static function values(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
