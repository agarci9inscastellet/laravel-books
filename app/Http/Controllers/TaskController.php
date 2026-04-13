<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Task;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function restricted(Request $request): string
    {

        if (Gate::allows('access-admin')) {
            return "YOU ARE IN A RESTRICTED AREA! (only admin)";
        }
        abort(403, 'Unauthorized!');
    }

    public function index()
    {
        $tasks = Task::with('department')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('tasks.create', compact('departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required'
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Nueva tarea creada correctamente');
    }

    public function edit(Task $task)
    {
        $departments = Department::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'departments', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
