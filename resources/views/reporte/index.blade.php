<!-- resources/views/reporte/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Generar Reporte</h1>
        <form action="{{ route('reporte.generar') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="userId">Ingrese el UserID:</label>
                <input type="text" name="userId" id="userId" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Generar Reporte</button>
        </form>
    </div>
@endsection
