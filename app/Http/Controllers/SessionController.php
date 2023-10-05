<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importa la clase DB para consultas SQL

class SessionController extends Controller
{
    public function index()
    {
        $sessions = DB::table('session')->get(); // Obtén todos los registros de la tabla 'session'

        return view('sessions.index', ['sessions' => $sessions]);
    }

    public function show($id)
    {
        $session = DB::table('session')->find($id); // Busca una sesión por su ID

        if (!$session) {
            abort(404); // Si no se encuentra la sesión, muestra un error 404
        }

        return view('sessions.show', ['session' => $session]);
    }

    // Otras acciones como create, edit, store, update, destroy, etc.

}
