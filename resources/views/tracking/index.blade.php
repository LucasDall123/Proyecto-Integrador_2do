<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>FixTech - Rastreo de Equipos</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark bg-background text-gray-100">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl w-full">
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-primary mb-2">FixTech</h1>
                    <p class="text-gray-400">Rastreo de Equipos</p>
                </div>

                <div class="bg-card rounded-lg shadow p-8">
                    <form action="{{ route('tracking.index') }}" method="GET" class="mb-8">
                        <div class="flex gap-4">
                            <input 
                                type="text" 
                                name="codigo" 
                                placeholder="Ingrese código de rastreo (ej: TRK-XXXXXX)" 
                                value="{{ old('codigo') }}"
                                class="flex-1 px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Buscar
                            </button>
                        </div>
                    </form>

                    @if($orden)
                        <div class="border-t border-gray-700 pt-8">
                            <h2 class="text-2xl font-semibold text-gray-100 mb-6">Estado del Equipo</h2>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                    <span class="text-gray-400">Código de Rastreo</span>
                                    <span class="font-mono text-primary font-bold">{{ $orden->codigo }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                    <span class="text-gray-400">Cliente</span>
                                    <span class="text-gray-100">{{ $orden->equipo->cliente->nombres }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                    <span class="text-gray-400">Equipo</span>
                                    <span class="text-gray-100">{{ $orden->equipo->marca_modelo }} ({{ $orden->equipo->tipo }})</span>
                                </div>
                                
                                <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                    <span class="text-gray-400">Estado Actual</span>
                                    @switch($orden->estado)
                                        @case('Ingresado')
                                            <span class="px-3 py-1 bg-blue-600 text-white rounded-full text-sm">{{ $orden->estado }}</span>
                                            @break
                                        @case('En Diagnóstico')
                                            <span class="px-3 py-1 bg-yellow-600 text-white rounded-full text-sm">{{ $orden->estado }}</span>
                                            @break
                                        @case('Esperando Repuesto')
                                            <span class="px-3 py-1 bg-orange-600 text-white rounded-full text-sm">{{ $orden->estado }}</span>
                                            @break
                                        @case('Listo p/ Retirar')
                                            <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm">{{ $orden->estado }}</span>
                                            @break
                                    @endswitch
                                </div>

                                <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                    <span class="text-gray-400">Fecha de Ingreso</span>
                                    <span class="text-gray-100">{{ $orden->fecha_ingreso->format('d/m/Y') }}</span>
                                </div>

                                @if($orden->fecha_entrega)
                                    <div class="flex justify-between items-center p-4 bg-gray-800 rounded-lg">
                                        <span class="text-gray-400">Fecha de Entrega</span>
                                        <span class="text-gray-100">{{ $orden->fecha_entrega->format('d/m/Y') }}</span>
                                    </div>
                                @endif

                                @if($orden->diagnostico_tecnico)
                                    <div class="p-4 bg-gray-800 rounded-lg">
                                        <span class="text-gray-400 block mb-2">Diagnóstico Técnico</span>
                                        <p class="text-gray-100">{{ $orden->diagnostico_tecnico }}</p>
                                    </div>
                                @endif

                                @if($orden->repuestos->count() > 0)
                                    <div class="p-4 bg-gray-800 rounded-lg">
                                        <span class="text-gray-400 block mb-2">Repuestos Solicitados</span>
                                        <ul class="space-y-2">
                                            @foreach($orden->repuestos as $repuesto)
                                                <li class="flex justify-between items-center">
                                                    <span class="text-gray-100">{{ $repuesto->nombre_pieza }}</span>
                                                    @switch($repuesto->estado_pedido)
                                                        @case('Pendiente')
                                                            <span class="px-2 py-1 bg-gray-600 text-white text-xs rounded">{{ $repuesto->estado_pedido }}</span>
                                                            @break
                                                        @case('Comprado')
                                                            <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded">{{ $repuesto->estado_pedido }}</span>
                                                            @break
                                                        @case('Recibido')
                                                            <span class="px-2 py-1 bg-green-600 text-white text-xs rounded">{{ $repuesto->estado_pedido }}</span>
                                                            @break
                                                    @endswitch
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif(request()->has('codigo'))
                        <div class="text-center text-red-400 mt-4">
                            <p>No se encontró ninguna orden con ese código.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
