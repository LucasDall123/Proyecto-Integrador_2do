<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;

class PublicTrackingController extends Controller
{
    public function index(Request $request)
    {
        $orden = null;
        if ($request->has('codigo')) {
            $orden = Orden::with(['equipo.cliente', 'repuestos'])
                ->where('codigo', strtoupper($request->codigo))
                ->first();
        }

        return view('tracking.index', compact('orden'));
    }
}
