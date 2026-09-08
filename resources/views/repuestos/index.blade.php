<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Gestión de Repuestos (Admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Solicitudes de Repuestos</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-4 py-3 text-left text-gray-300">Pieza</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Orden</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Cliente</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Motivo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Estado</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repuestos as $repuesto)
                                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-100">{{ $repuesto->nombre_pieza }}</td>
                                        <td class="px-4 py-3 text-gray-100 font-mono">{{ $repuesto->orden->codigo }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $repuesto->orden->equipo->cliente->nombres }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $repuesto->motivo ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            @switch($repuesto->estado_pedido)
                                                @case('Pendiente')
                                                    <span class="px-2 py-1 bg-gray-600 text-white text-sm rounded">{{ $repuesto->estado_pedido }}</span>
                                                    @break
                                                @case('Comprado')
                                                    <span class="px-2 py-1 bg-blue-600 text-white text-sm rounded">{{ $repuesto->estado_pedido }}</span>
                                                    @break
                                                @case('Recibido')
                                                    <span class="px-2 py-1 bg-green-600 text-white text-sm rounded">{{ $repuesto->estado_pedido }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="px-4 py-3">
                                            <form action="{{ route('repuestos.updateStatus', $repuesto) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="estado_pedido" onchange="this.form.submit()"
                                                    class="px-3 py-1 bg-gray-800 border border-gray-700 rounded text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                                                    <option value="Pendiente" {{ $repuesto->estado_pedido === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="Comprado" {{ $repuesto->estado_pedido === 'Comprado' ? 'selected' : '' }}>Comprado</option>
                                                    <option value="Recibido" {{ $repuesto->estado_pedido === 'Recibido' ? 'selected' : '' }}>Recibido</option>
                                                </select>
                                            </form>
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
