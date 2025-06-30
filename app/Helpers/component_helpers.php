<?php

if (!function_exists('taskStatusBadge')) {
    function taskStatusBadge(string $status): string
    {
        $color = match ($status) {
            'todo' => 'secondary',
            'in-progress' => 'warning',
            'done' => 'success',
            default => 'secondary',
        };

        return '<span class="badge bg-' . $color . '">' . ucfirst(getTaskStatus($status)) . '</span>';
    }
}

if (!function_exists('taskIsPublishedBadge')) {
    function taskIsPublishedBadge(?int $status): string
    {
        $color = match ($status) {
            1 => 'success',
            0 => 'warning',
            default => 'warning',
        };

        return '<span class="badge bg-' . $color . '">' . ucfirst(getTaskIsPublished($status)) . '</span>';
    }
}
