<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->whereIn('email', ['admin@deportivo.test', 'socio@deportivo.test'])->delete();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@deportivo.test',
            'password' => 'password',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Socio de prueba',
            'email' => 'socio@deportivo.test',
            'password' => 'password',
            'role' => 'normal',
            'email_verified_at' => now(),
        ]);

        $definitions = [
            ['name' => 'Pádel', 'description' => 'Pista cubierta, iluminación LED.', 'max_capacity' => 4, 'image_path' => 'images/padel.jpg'],
            ['name' => 'Crossfit', 'description' => 'Zona de pesas y máquinas, sesión guiada.', 'max_capacity' => 20, 'image_path' => 'images/musculacion.jpg'],
            ['name' => 'Yoga', 'description' => 'Nivel mixto. Lleva esterilla.', 'max_capacity' => 15, 'image_path' => 'images/clase-de-yoga.jpg'],
            ['name' => 'Piscina — calle libre', 'description' => 'Carril para nado libre.', 'max_capacity' => 8, 'image_path' => 'images/natacion.jpg'],
            ['name' => 'Spinning', 'description' => 'Bici fija con monitor cardíaco.', 'max_capacity' => 12, 'image_path' => 'images/spinning.jpg'],
        ];

        foreach ($definitions as $def) {
            $activity = Activity::create([
                'name' => $def['name'],
                'description' => $def['description'],
                'max_capacity' => $def['max_capacity'],
                'image_path' => $def['image_path'] ?? null,
            ]);

            for ($i = 0; $i < 3; $i++) {
                $start = now()->addDays($i + 1)->setHour(10 + $i)->setMinute(0)->setSecond(0);
                $end = (clone $start)->addHour();
                $activity->timeSlots()->create([
                    'start_time' => $start,
                    'end_time' => $end,
                ]);
            }
        }
    }
}
