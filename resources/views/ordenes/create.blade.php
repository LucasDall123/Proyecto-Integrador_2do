<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Nueva Orden de Reparación
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <form action="{{ route('ordenes.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Equipo</label>
                            <select name="equipo_id" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Seleccione un equipo</option>
                                @foreach($equipos as $equipo)
                                    <option value="{{ $equipo->id }}">{{ $equipo->marca_modelo }} ({{ $equipo->tipo }}) - {{ $equipo->cliente->nombres }}</option>
                                @endforeach
                            </select>
                            @error('equipo_id')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Falla Reportada</label>
                            <textarea name="falla_reportada" rows="4" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">{{ old('falla_reportada') }}</textarea>
                            @error('falla_reportada')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Crear Orden
                            </button>
                            <a href="{{ route('ordenes.index') }}" class="px-6 py-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-gray-600 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
