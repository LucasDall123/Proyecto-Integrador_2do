<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Cliente: {{ $cliente->nombres }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Nombre</span>
                        <span class="text-gray-100 text-lg">{{ $cliente->nombres }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">DNI</span>
                        <span class="text-gray-100 text-lg font-mono">{{ $cliente->dni }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Teléfono</span>
                        <span class="text-gray-100 text-lg">{{ $cliente->telefono }}</span>
                    </div>
                    <div class="p-4 bg-gray-800 rounded">
                        <span class="text-gray-400 block mb-1">Email</span>
                        <span class="text-gray-100 text-lg">{{ $cliente->email ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-100 mb-4">Equipos del Cliente</h3>
                
                @if($cliente->equipos->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="px-4 py-3 text-left text-gray-300">Tipo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Marca/Modelo</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Serie/IMEI</th>
                                    <th class="px-4 py-3 text-left text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->equipos as $equipo)
                                    <tr class="border-b border-gray-700 hover:bg-gray-800">
                                        <td class="px-4 py-3 text-gray-100">{{ $equipo->tipo }}</td>
                                        <td class="px-4 py-3 text-gray-100">{{ $equipo->marca_modelo }}</td>
                                        <td class="px-4 py-3 text-gray-100 font-mono">{{ $equipo->nro_serie_imei }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('equipos.show', $equipo) }}" class="text-primary hover:text-blue-400">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-400">Este cliente no tiene equipos registrados.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
