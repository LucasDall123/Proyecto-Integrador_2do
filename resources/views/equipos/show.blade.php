<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Equipo: {{ $equipo->marca_modelo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Tipo</span>
                        <span class="text-gray-100 text-lg">{{ $equipo->tipo }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Marca/Modelo</span>
                        <span class="text-gray-100 text-lg">{{ $equipo->marca_modelo }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Serie/IMEI</span>
                        <span class="text-gray-100 text-lg font-mono">{{ $equipo->nro_serie_imei }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Cliente</span>
                        <span class="text-gray-100 text-lg">{{ $equipo->cliente->nombres }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-100 mb-4">Órdenes de Reparación</h3>
                
                @if($equipo->ordenes->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-4 py-3 text-left text-gray-300">Código</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Estado</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Fecha Ingreso</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($equipo->ordenes as $orden)
                                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-100 font-mono">{{ $orden->codigo }}</td>
                                        <td class="px-4 py-3">
                                            @switch($orden->estado)
                                                @case('Ingresado')
                                                    <span class="px-2 py-1 bg-blue-600 text-white text-sm rounded">{{ $orden->estado }}</span>
                                                    @break
                                                @case('En Diagnóstico')
                                                    <span class="px-2 py-1 bg-yellow-600 text-white text-sm rounded">{{ $orden->estado }}</span>
                                                    @break
                                                @case('Esperando Repuesto')
                                                    <span class="px-2 py-1 bg-orange-600 text-white text-sm rounded">{{ $orden->estado }}</span>
                                                    @break
                                                @case('Listo p/ Retirar')
                                                    <span class="px-2 py-1 bg-green-600 text-white text-sm rounded">{{ $orden->estado }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="px-4 py-3 text-gray-100">{{ $orden->fecha_ingreso->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('ordenes.show', $orden) }}" class="text-primary hover:text-blue-400">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-400">Este equipo no tiene órdenes de reparación.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
