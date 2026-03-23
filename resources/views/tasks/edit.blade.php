@extends('layouts.base') {{-- Assuming you have a layout file --}}


@section('content')

<div class="row mt-4">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center">

            <h2>Editar Tarea</h2>

            <a href="{{ route('tasks.index') }}" class="btn btn-primary">
                Volver
            </a>

        </div>

    </div>

</div>


@if ($errors->any())

<div class="alert alert-danger mt-3">

    <strong>Algo fue mal...</strong>

    <ul>

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif


<form action="{{ route('tasks.update',$task->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="row mt-3">

        <div class="col-md-12 mt-2">

            <label class="form-label"><strong>Tarea:</strong></label>

            <input
                type="text"
                name="title"
                value="{{ $task->title }}"
                class="form-control">

        </div>


        <div class="col-md-12 mt-3">

            <label class="form-label"><strong>Descripción:</strong></label>

            <textarea
                class="form-control"
                style="height:150px"
                name="description">{{ $task->description }}</textarea>

        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control">
                <option value="">Select a department</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id', $task->department_id) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="col-md-6 mt-3">

            <label class="form-label"><strong>Fecha límite:</strong></label>

            <input
                type="date"
                name="due_date"
                value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}"
                class="form-control">

        </div>




        <!-- <div class="form-group">
            <label for="department_id">Usuarios</label>
            <select name="department_id" id="department_id" class="form-control">
                <option value="">Select a user</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div> -->


        <div class="col-md-6 mt-3">

            <label class="form-label"><strong>Estado:</strong></label>

            <select name="status" class="form-select">

                <option value="Pendiente" {{ $task->status == 'Pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="En progreso" {{ $task->status == 'En progreso' ? 'selected' : '' }}>
                    En progreso
                </option>

                <option value="Completada" {{ $task->status == 'Completada' ? 'selected' : '' }}>
                    Completada
                </option>

            </select>

        </div>


        <div class="col-md-12 text-center mt-4">

            <button type="submit" class="btn btn-success">
                Actualizar
            </button>

        </div>

    </div>

</form>

@endsection
