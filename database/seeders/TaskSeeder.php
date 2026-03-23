<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        DB::table('tasks')->insert([
            [
                'title' => 'Revisar el código',
                'description' => 'Revisar el código del nuevo módulo de autenticación.',
                'due_date' => Carbon::now()->addDays(2),
                'status' => 'Pendiente',
                'department_id' => $departments->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Escribir tests',
                'description' => 'Escribir tests unitarios para el TaskController.',
                'due_date' => Carbon::now()->addDays(5),
                'status' => 'En progreso',
                'department_id' => $departments->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Desplegar a producción',
                'description' => 'Desplegar la última versión de la aplicación al servidor de producción.',
                'due_date' => Carbon::now()->addWeek(),
                'status' => 'Completada',
                'department_id' => $departments->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
