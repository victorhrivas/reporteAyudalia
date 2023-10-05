<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reporte.index');
    }

    public function generarReporte(Request $request)
    {
        $userId = $request->input('userId');

        // Obtener el último registro de la tabla 'sessions' para el 'userId'
        $session = Session::where('userId', $userId)->latest()->first();

        if (!$session) {
            // Manejo de error: No se encontraron registros para el UserID proporcionado
            return view('reporte.resultado', ['session' => null, 'variabilidad' => null]);
        }

        // Obtener el texto de la columna 'json'
        $jsonText = $session->json;

        // Procesar el texto para extraer valores de mediaTR y perseveraciones
        $mediaTR = null;
        $perseveraciones = null;

        if (preg_match('/"mediaTR":\s*"(.*?)"/', $jsonText, $matchesMediaTR)) {
            $mediaTR = $matchesMediaTR[1];
        }

        if (preg_match('/"perseveraciones":\s*"(.*?)"/', $jsonText, $matchesPerseveraciones)) {
            $perseveraciones = $matchesPerseveraciones[1];
        }

        // Calcular la variabilidad de mediaTR
        $variabilidadMediaTR = $this->calcularVariabilidad($mediaTR);

        // Procesa mediaTR
        $mediaTR = str_replace(["{", "}"], "", $mediaTR); // Elimina las llaves
        $valoresMediaTR = explode(",", $mediaTR); // Convierte la cadena en un array de números

        return view('reporte.resultado', [
            'session' => $session,
            'mediaTR' => $mediaTR,
            'perseveraciones' => $perseveraciones,
            'variabilidad' => $variabilidadMediaTR,
            'valoresMediaTR' => $valoresMediaTR,
        ]);
    }

    // Función para calcular la variabilidad de mediaTR
    private function calcularVariabilidad($mediaTR)
    {
        // Separa los valores de mediaTR en un array utilizando ',' como separador
        $valoresMediaTR = explode(',', $mediaTR);

        // Convierte los valores a números
        $valoresNumericos = array_map('floatval', $valoresMediaTR);

        // Calcula la variabilidad (en este caso, la desviación estándar)
        $variabilidad = 0;

        if (count($valoresNumericos) > 1) {
            $media = array_sum($valoresNumericos) / count($valoresNumericos);
            $varianza = array_sum(array_map(function ($x) use ($media) {
                return pow($x - $media, 2);
            }, $valoresNumericos)) / (count($valoresNumericos) - 1);
            $variabilidad = sqrt($varianza);
        }

        return $variabilidad;
    }
}
