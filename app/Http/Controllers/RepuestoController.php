<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repuesto;

class RepuestoController extends Controller
{
    public function index()
    {
        $repuestos = Repuesto::with(['orden.equipo.cliente'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('repuestos.index', compact('repuestos'));
    }

    public function updateStatus(Request $request, Repuesto $repuesto)
    {
        $validated = $request->validate([
            'estado_pedido' => 'required|in:Pendiente,Comprado,Recibido',
        ]);

        $repuesto->update($validated);
        return redirect()->route('repuestos.index')->with('success', 'Estado del repuesto actualizado.');
    }
}
