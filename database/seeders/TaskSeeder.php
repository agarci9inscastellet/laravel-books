<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('1234'), // Hash the password
        ]);

        $departments = Department::all();

        $tasks = [
            [
                'title' => 'Revisar el código',
                'description' => 'Revisar el código del nuevo módulo de autenticación.',
                'due_date' => Carbon::now()->addDays(2),
                'status' => 'Pendiente',
                'department_id' => $departments->random()->id,
            ],
            [
                'title' => 'Escribir tests',
                'description' => 'Escribir tests unitarios para el TaskController.',
                'due_date' => Carbon::now()->addDays(5),
                'status' => 'En progreso',
                'department_id' => $departments->random()->id,
            ],
            [
                'title' => 'Desplegar a producción',
                'description' => 'Desplegar la última versión de la aplicación al servidor de producción.',
                'due_date' => Carbon::now()->addWeek(),
                'status' => 'Completada',
                'department_id' => $departments->random()->id,
            ]
        ];

        foreach ($tasks as $taskData) {
            $task = Task::create($taskData);
            $task->users()->attach($user->id);
        }
    }
}
