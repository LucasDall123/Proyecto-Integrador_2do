<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard - FixTech') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100">Total Órdenes</h3>
                    <p class="text-3xl font-bold text-primary mt-2">{{ $metrics['total_ordenes'] }}</p>
                </div>
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100">En Diagnóstico</h3>
                    <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $metrics['en_diagnostico'] }}</p>
                </div>
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100">Esperando Repuesto</h3>
                    <p class="text-3xl font-bold text-orange-500 mt-2">{{ $metrics['esperando_repuesto'] }}</p>
                </div>
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100">Listo p/ Retirar</h3>
                    <p class="text-3xl font-bold text-green-500 mt-2">{{ $metrics['listo_retirar'] }}</p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Órdenes Recientes</h3>
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
