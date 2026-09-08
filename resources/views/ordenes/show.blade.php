<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Orden: {{ $orden->codigo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Order Details -->
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Detalles de la Orden</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                            <span class="text-gray-400">Código</span>
                            <span class="font-mono text-primary font-bold">{{ $orden->codigo }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                            <span class="text-gray-400">Cliente</span>
                            <span class="text-gray-100">{{ $orden->equipo->cliente->nombres }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                            <span class="text-gray-400">Equipo</span>
                            <span class="text-gray-100">{{ $orden->equipo->marca_modelo }} ({{ $orden->equipo->tipo }})</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                            <span class="text-gray-400">Estado</span>
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
                        </div>

                        <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                            <span class="text-gray-400">Fecha Ingreso</span>
                            <span class="text-gray-100">{{ $orden->fecha_ingreso->format('d/m/Y') }}</span>
                        </div>

                        @if($orden->fecha_entrega)
                            <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                                <span class="text-gray-400">Fecha Entrega</span>
                                <span class="text-gray-100">{{ $orden->fecha_entrega->format('d/m/Y') }}</span>
                            </div>
                        @endif

                        <div class="p-3 bg-gray-800 rounded">
                            <span class="text-gray-400 block mb-2">Falla Reportada</span>
                            <p class="text-gray-100">{{ $orden->falla_reportada }}</p>
                        </div>

                        @if($orden->diagnostico_tecnico)
                            <div class="p-3 bg-gray-800 rounded">
                                <span class="text-gray-400 block mb-2">Diagnóstico Técnico</span>
                                <p class="text-gray-100">{{ $orden->diagnostico_tecnico }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Update Form -->
                <div class="bg-card rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Actualizar Orden</h3>
                    
                    <form action="{{ route('ordenes.update', $orden) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Estado</label>
                            <select name="estado" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="Ingresado" {{ $orden->estado === 'Ingresado' ? 'selected' : '' }}>Ingresado</option>
                                <option value="En Diagnóstico" {{ $orden->estado === 'En Diagnóstico' ? 'selected' : '' }}>En Diagnóstico</option>
                                <option value="Esperando Repuesto" {{ $orden->estado === 'Esperando Repuesto' ? 'selected' : '' }}>Esperando Repuesto</option>
                                <option value="Listo p/ Retirar" {{ $orden->estado === 'Listo p/ Retirar' ? 'selected' : '' }}>Listo p/ Retirar</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Diagnóstico Técnico</label>
                            <textarea name="diagnostico_tecnico" rows="4"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('diagnostico_tecnico', $orden->diagnostico_tecnico) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Fecha de Entrega (opcional)</label>
                            <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega', $orden->fecha_entrega ? $orden->fecha_entrega->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                            Actualizar
                        </button>
                    </form>
                </div>

                <!-- Spare Parts -->
                <div class="bg-card rounded-lg shadow p-6 lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Repuestos Solicitados</h3>
                    
                    @if($orden->repuestos->count() > 0)
                        <div class="overflow-x-auto mb-4">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="px-4 py-3 text-left text-gray-300">Pieza</th>
                                        <th class="px-4 py-3 text-left text-gray-300">Motivo</th>
                                        <th class="px-4 py-3 text-left text-gray-300">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orden->repuestos as $repuesto)
                                        <tr class="border-b border-gray-700">
                                            <td class="px-4 py-3 text-gray-100">{{ $repuesto->nombre_pieza }}</td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-400 mb-4">No hay repuestos solicitados.</p>
                    @endif

                    <form action="{{ route('ordenes.addRepuesto', $orden) }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <input type="text" name="nombre_pieza" placeholder="Nombre de la pieza" required
                                class="flex-1 px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            <input type="text" name="motivo" placeholder="Motivo (opcional)"
                                class="flex-1 px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Solicitar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
