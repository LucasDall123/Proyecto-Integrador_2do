<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Editar Cliente
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card rounded-lg shadow">
                <div class="p-6">
                    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Nombre Completo</label>
                            <input type="text" name="nombres" value="{{ old('nombres', $cliente->nombres) }}" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('nombres')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $cliente->dni) }}" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('dni')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('telefono')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Email (opcional)</label>
                            <input type="email" name="email" value="{{ old('email', $cliente->email) }}"
                                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Actualizar
                            </button>
                            <a href="{{ route('clientes.index') }}" class="px-6 py-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-gray-600 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
