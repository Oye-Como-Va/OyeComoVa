<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Creamos unos cuantos usuarios para la demo:
        $users = [
            [
                'name' => 'Juan',
                'surname' => 'Pérez',
                'email' => 'juan@example.com',
                'phone' => '555991234',
                'password' => 'password123',
            ],
            [
                'name' => 'María',
                'surname' => 'Rodríguez',
                'email' => 'maria@example.com',
                'phone' => '555995678',
                'password' => 'password456',
            ],
            [
                'name' => 'Pedro',
                'surname' => 'González',
                'email' => 'pedro@example.com',
                'phone' => '555999876',
                'password' => 'password789',
            ], [
                'name' => 'Laura',
                'surname' => 'Fernández',
                'profile_image' => NULL,
                'email' => 'laura@example.com',
                'phone' => '555996543',
                'admin' => 0,
                'completed_tasks' => '10',
                'pending_tasks' => '2',
                'respected_tasks' => '8',
                'unrespected_tasks' => '0',
                'email_verified_at' => NULL,
                'password' => 'password333',
            ],
            [
                'name' => 'Carlos',
                'surname' => 'Martínez',
                'profile_image' => NULL,
                'email' => 'carlos@example.com',
                'phone' => '555997890',
                'admin' => 0,
                'completed_tasks' => '5',
                'pending_tasks' => '0',
                'respected_tasks' => '3',
                'unrespected_tasks' => '1',
                'email_verified_at' => NULL,
                'password' => 'password555',
            ],
            [
                'name' => 'Ana',
                'surname' => 'López',
                'profile_image' => NULL,
                'email' => 'ana@example.com',
                'phone' => '555994321',
                'admin' => 1,
                'completed_tasks' => '50',
                'pending_tasks' => '10',
                'respected_tasks' => '45',
                'unrespected_tasks' => '2',
                'email_verified_at' => NULL,
                'password' => 'password123',
            ],
            [
                'name' => 'Jorge',
                'surname' => 'Ramírez',
                'profile_image' => NULL,
                'email' => 'jorge@example.com',
                'phone' => '555995678',
                'admin' => 0,
                'completed_tasks' => '25',
                'pending_tasks' => '5',
                'respected_tasks' => '20',
                'unrespected_tasks' => '1',
                'email_verified_at' => NULL,
                'password' => 'password2525',
            ],

        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'surname' => $user['surname'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => Hash::make($user['password']),
            ]);
        }

        $sql = database_path(path: 'oyecomova.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
