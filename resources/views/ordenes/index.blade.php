<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Órdenes de Reparación
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-100">Todas las Órdenes</h3>
                        <a href="{{ route('ordenes.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                            Nueva Orden
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-4 py-3 text-left text-gray-300">Código</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Cliente</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Equipo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Estado</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Fecha Ingreso</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordenes as $orden)
                                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-100 font-mono">{{ $orden->codigo }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $orden->equipo->cliente->nombres }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $orden->equipo->marca_modelo }}</td>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
