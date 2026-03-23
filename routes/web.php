<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Department;
use App\Http\Controllers\DepartmentController;
use App\Models\Task;

Route::redirect('/', '/tasks');

Route::resource('tasks', TaskController::class);

Route::resource('departments', DepartmentController::class);

Route::get("tasks/dept/{id}", function($id){
    $department = Department::find($id);
    $tasks = $department->tasks;

// $tasks = Task::with('department')
//              ->where('department_id', 2)
//              ->get();

    echo "<h1>Department: " . $department->name . "</h1><br>";
    echo "Tasks:<br>";
    foreach ($tasks as $task) {
    echo "Title: " . $task->title . "<br>";
    echo "Date: " . $task->due_date . "<br>";
    echo "Status: " . $task->status . "<br>------------------------<br>";
}
    return "TEEEST" ;
});


