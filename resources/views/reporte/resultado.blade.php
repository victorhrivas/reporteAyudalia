@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultado del Reporte</h1>
        @if ($session)
            <h2>UserID: {{ $session->userId }}</h2>
            <h3>MediaTR:</h3>
            <p>{{ $mediaTR }}</p>
            <h3>Perseveraciones:</h3>
            <p>{{ $perseveraciones }}</p>
            @if ($variabilidad !== null)
                <h3>Variabilidad de MediaTR:</h3>
                <p>{{ $variabilidad }}</p>
            @else
                <p>No se pudo calcular la variabilidad de MediaTR.</p>
            @endif
        @else
            <p>No se encontraron registros para el UserID proporcionado.</p>
        @endif

        <canvas id="graficoMediaTR" width="400" height="200"></canvas>

        <script   script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('graficoMediaTR').getContext('2d');
            var valoresMediaTR = @json($valoresMediaTR); // Obtener los valores desde Laravel

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Valor 1', 'Valor 2', 'Valor 3', 'Valor 4', 'Valor 5'],
                    datasets: [{
                        label: 'MediaTR',
                        data: valoresMediaTR,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de fondo
                        borderColor: 'rgba(75, 192, 192, 1)', // Color del borde
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <a href="{{ route('reporte.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection
