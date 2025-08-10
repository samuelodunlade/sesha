<?php
    return [
        
        'options' => [
            '1_hour' => '1 Hour',
            '6_hours' => '6 Hours',
            '1_day' => '1 Day',
            '1_week' => '1 Week',
            '1_month' => '1 Month',
            'never' => 'Never Expire',
        ],
        
        'durations' => [
            '1_hour' => now()->addHour(),
            '6_hours' => now()->addHours(6),
            '1_day' => now()->addDay(),
            '1_week' => now()->addWeek(),
            '1_month' => now()->addMonth(),
            'never' => null,
        ],
    ];

