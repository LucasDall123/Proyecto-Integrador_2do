<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Editar Equipo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <form action="{{ route('equipos.update', $equipo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Cliente</label>
                            <select name="cliente_id" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $equipo->cliente_id === $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombres }} ({{ $cliente->dni }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Tipo de Equipo</label>
                            <select name="tipo" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Seleccione tipo</option>
                                <option value="Celular" {{ $equipo->tipo === 'Celular' ? 'selected' : '' }}>Celular</option>
                                <option value="Laptop" {{ $equipo->tipo === 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                <option value="Tablet" {{ $equipo->tipo === 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="Otro" {{ $equipo->tipo === 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('tipo')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Marca y Modelo</label>
                            <input type="text" name="marca_modelo" value="{{ old('marca_modelo', $equipo->marca_modelo) }}" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('marca_modelo')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Número de Serie / IMEI</label>
                            <input type="text" name="nro_serie_imei" value="{{ old('nro_serie_imei', $equipo->nro_serie_imei) }}" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('nro_serie_imei')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Actualizar
                            </button>
                            <a href="{{ route('equipos.index') }}" class="px-6 py-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-gray-600 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
