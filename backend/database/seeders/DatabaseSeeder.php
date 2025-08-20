<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Events;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'id' => 1,
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]
        );

        $events = [
            ['name' => 'Заправка'],
            ['name' => 'Мойка'],
            ['name' => 'Ремонт'],
            ['name' => 'Техническое обслуживание (ТО)'],
            ['name' => 'ДТП'],
            ['name' => 'Тюнинг'],
            ['name' => 'Налог'],
            ['name' => 'Страховка']
        ];
        foreach ($events as $event) {
            Events::firstOrCreate($event);
        }
    }
}
