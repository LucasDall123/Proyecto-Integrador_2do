<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Equipo;
use App\Models\Repuesto;
use Illuminate\Support\Str;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with(['equipo.cliente', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $equipos = Equipo::with('cliente')->get();
        return view('ordenes.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'falla_reportada' => 'required|string',
        ]);

        $codigo = 'TRK-' . strtoupper(Str::random(8));

        $orden = Orden::create([
            'equipo_id' => $validated['equipo_id'],
            'usuario_id' => auth()->id(),
            'codigo' => $codigo,
            'falla_reportada' => $validated['falla_reportada'],
            'estado' => 'Ingresado',
            'fecha_ingreso' => now()->toDateString(),
        ]);

        return redirect()->route('ordenes.show', $orden)->with('success', 'Orden creada con código: ' . $codigo);
    }

    public function show(Orden $orden)
    {
        $orden->load(['equipo.cliente', 'usuario', 'repuestos']);
        return view('ordenes.show', compact('orden'));
    }

    public function update(Request $request, Orden $orden)
    {
        $validated = $request->validate([
            'diagnostico_tecnico' => 'nullable|string',
            'estado' => 'required|in:Ingresado,En Diagnóstico,Esperando Repuesto,Listo p/ Retirar',
            'fecha_entrega' => 'nullable|date',
        ]);

        $orden->update($validated);
        return redirect()->route('ordenes.show', $orden)->with('success', 'Orden actualizada correctamente.');
    }

    public function addRepuesto(Request $request, Orden $orden)
    {
        $validated = $request->validate([
            'nombre_pieza' => 'required|string|max:255',
            'motivo' => 'nullable|string',
        ]);

        Repuesto::create([
            'orden_id' => $orden->id,
            'nombre_pieza' => $validated['nombre_pieza'],
            'motivo' => $validated['motivo'],
            'estado_pedido' => 'Pendiente',
        ]);

        return redirect()->route('ordenes.show', $orden)->with('success', 'Repuesto solicitado correctamente.');
    }
}
