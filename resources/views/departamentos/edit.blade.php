<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Departamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form edit --}}
                    <form action="{{ route('departamentos.update', $departamento) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de departamento') }}
                            </label>
                            <input type="text" id="nro" name="nro"
                                value="{{ old('nro', $departamento->nro) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Precio') }}
                            </label>
                            <input type="number" id="precio" name="precio"
                                value="{{ old('precio', $departamento->precio) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('precio') border-red-600  @enderror">
                            @error('precio')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="sanitario" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Sanitario') }}
                            </label>
                            <input type="number" id="sanitario" name="sanitario"
                                value="{{ old('sanitario', $departamento->sanitario) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('sanitario') border-red-600  @enderror">
                            @error('sanitario')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="cocina" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Cocina') }}
                            </label>
                            <input type="number" id="cocina" name="cocina"
                                value="{{ old('cocina', $departamento->cocina) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('cocina') border-red-600  @enderror">
                            @error('cocina')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="piso" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Piso') }}
                            </label>
                            <input type="number" id="piso" name="piso"
                                value="{{ old('piso', $departamento->piso) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('piso') border-red-600  @enderror">
                            @error('piso')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="from-group">
                            <label for="inventario_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Muebles') }}
                            </label>
                            <select id="inventario_id" name="inventario_id[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                multiple required>
                                @foreach ($inventarios as $inventario)
                                    <option value="{{ $inventario->id }}"
                                        {{ in_array($inventario->id, old('inventarios', $departamento->inventarios->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $inventario->codigo . '-' . $inventario->estado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inventario_codigo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="mb-6">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Detalle') }}
                            </label>
                            <input type="text" id="detalle" name="detalle"
                                value="{{ old('detalle', $departamento->detalle) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('detalle') border-red-600  @enderror">
                            @error('detalle')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="edificio_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Edificio de trabajo') }}
                            </label>
                            <select id="edificio_id" name="edificio_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($edificios as $edificio)
                                    <option value="{{ $edificio->id }}" @selected($edificio->id == $departamento->edificio->id)>
                                        {{ $edificio->nombre . ' - ' . $edificio->getCiudad() }}</option>
                                @endforeach
                            </select>
                            @error('edificio_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('departamentos.index') }}">
                                <span
                                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    {{ __('Go back') }}
                                </span>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
