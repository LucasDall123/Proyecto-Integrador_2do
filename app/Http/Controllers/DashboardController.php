<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;

class DashboardController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with(['equipo.cliente', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();

        $metrics = [
            'total_ordenes' => $ordenes->count(),
            'en_diagnostico' => $ordenes->where('estado', 'En Diagnóstico')->count(),
            'esperando_repuesto' => $ordenes->where('estado', 'Esperando Repuesto')->count(),
            'listo_retirar' => $ordenes->where('estado', 'Listo p/ Retirar')->count(),
        ];

        return view('dashboard', compact('ordenes', 'metrics'));
    }
}
