@extends('layouts.base')

@section('content')

<div class="row mt-4">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <h2>CRUD de Tareas</h2>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            Crear tarea
        </a>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success mt-3">
    {{ session('success') }}
</div>

@endif

<div class="row mt-4">

    <div class="col-12">

        <table class="table table-bordered text-white">

            <thead>

                <tr class="text-secondary">
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Department</th>
                    <th>Fecha</th>
                    <th>Usuarios</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($tasks as $task)

                <tr>

                    <td class="fw-bold">
                        {{ $task->title }}
                    </td>

                    <td>
                        {{ $task->description }}
                    </td>
                <td>{{ $task->department?->name ?? 'N/A' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                    </td>

                    <td>
                         @foreach ($task->users as $user)
                            >>> [{{ $user->name }}] /
                        @endforeach

                    </td>
                    
                    <td>

                        @if($task->status == 'Pendiente')
                        <span class="badge bg-warning fs-6">
                            Pendiente
                        </span>

                        @elseif($task->status == 'En progreso')
                        <span class="badge bg-info fs-6">
                            En progreso
                        </span>

                        @else
                        <span class="badge bg-success fs-6">
                            Completada
                        </span>
                        @endif

                    </td>

                    <td>

                        <a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection

