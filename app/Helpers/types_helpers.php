<?php

if (!function_exists('taskStatusType')) {
    function taskStatusType(): array
    {
        return [
            'todo' => "To Do",
            'in-progress' => "In Progress",
            'done' => "Done",
        ];
    }
}

if (!function_exists('getTaskIsPublished')) {
    function getTaskIsPublished($status): string
    {
        return match ($status) {
            1 => 'Published',
            0 => 'Draft',
            default => 'Draft',
        };
    }
}

if (!function_exists('getTaskStatus')) {
    function getTaskStatus($status): string
    {
        return match ($status) {
            'todo' => "To Do",
            'in-progress' => "In Progress",
            'done' => "Done",
            default => 'To Do',
        };
    }
}

if (!function_exists('taskOrderByOptions')) {
    function taskOrderByOptions(): array
    {
        return [
            'created_at_desc' => "Created Date (Newest First)",
            'created_at_asc' => "Created Date (Oldest First)",
            'title_asc' => "Title (A–Z)",
            'title_desc' => "Title (Z–A)",
        ];
    }
}

if (!function_exists('pageLimiterOption')) {
    function pageLimiterOption(): array
    {
        return [
            10 => 10,
            20 => 20,
            50 => 50,
            100 => 100
        ];
    }
}