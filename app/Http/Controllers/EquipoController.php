<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Cliente;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::with('cliente')->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('equipos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'nro_serie_imei' => 'required|string|unique:equipos,nro_serie_imei',
        ]);

        Equipo::create($validated);
        return redirect()->route('equipos.index')->with('success', 'Equipo registrado correctamente.');
    }

    public function show(Equipo $equipo)
    {
        $equipo->load('cliente', 'ordenes');
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        $clientes = Cliente::all();
        return view('equipos.edit', compact('equipo', 'clientes'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'nro_serie_imei' => 'required|string|unique:equipos,nro_serie_imei,' . $equipo->id,
        ]);

        $equipo->update($validated);
        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
