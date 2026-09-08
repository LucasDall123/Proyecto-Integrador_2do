<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Equipos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-100">Inventario de Equipos</h3>
                        <a href="{{ route('equipos.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                            Nuevo Equipo
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-4 py-3 text-left text-gray-300">Tipo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Marca/Modelo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Serie/IMEI</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Cliente</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($equipos as $equipo)
                                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-100">{{ $equipo->tipo }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $equipo->marca_modelo }}</td>
                                        <td class="px-4 py-3 text-gray-100 font-mono">{{ $equipo->nro_serie_imei }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $equipo->cliente->nombres }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('equipos.show', $equipo) }}" class="text-primary hover:text-blue-400 mr-3">Ver</a>
                                            <a href="{{ route('equipos.edit', $equipo) }}" class="text-yellow-500 hover:text-yellow-400 mr-3">Editar</a>
                                            <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400" onclick="return confirm('¿Está seguro?')">Eliminar</button>
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
