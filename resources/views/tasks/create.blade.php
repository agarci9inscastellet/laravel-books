@extends('layouts.base')

@section('content')

<div class="row mt-4">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center">

            <h2>Crear Tarea</h2>

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


<form action="{{ route('tasks.store') }}" method="POST">

    @csrf

    <div class="row mt-3">

        <div class="col-md-12 mt-2">

            <label class="form-label"><strong>Tarea:</strong></label>

            <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Tarea">

        </div>


        <div class="col-md-12 mt-3">

            <label class="form-label"><strong>Descripción:</strong></label>

            <textarea
                class="form-control"
                style="height:150px"
                name="description"
                placeholder="Descripción..."></textarea>

        </div>
        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" id="department_id" class="form-control">
                <option value="">Select a department</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                class="form-control">

        </div>


        <div class="col-md-6 mt-3">

            <label class="form-label"><strong>Estado (inicial):</strong></label>

            <select name="status" class="form-select">

                <option value="">-- Elige el status --</option>

                <option value="Pendiente">Pendiente</option>
                <option value="En progreso">En progreso</option>
                <option value="Completada">Completada</option>

            </select>

        </div>


        <div class="col-md-12 text-center mt-4">

            <button type="submit" class="btn btn-primary">
                Crear
            </button>

        </div>

    </div>

</form>

@endsection

