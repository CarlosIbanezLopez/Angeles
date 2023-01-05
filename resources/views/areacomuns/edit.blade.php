<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Area comun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form edit --}}
                    <form action="{{ route('areacomuns.update', $areacomun) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nombre') }}
                            </label>
                            <input type="text" id="nombre" name="nombre"
                                value="{{ old('nombre', $areacomun->nombre) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombre') border-red-600  @enderror">
                            @error('nombre')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Precio') }}
                            </label>
                            <input type="number" id="precio" name="precio"
                                value="{{ old('precio', $areacomun->precio) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('precio') border-red-600  @enderror">
                            @error('precio')
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
                                        {{ in_array($inventario->id, old('inventarios', $areacomun->inventarios->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $inventario->codigo . '-' . $inventario->estado }}
                                    </option>
                                @endforeach







                            </select>
                            @error('inventario_codigo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="mb-6">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Descripcion') }}
                            </label>
                            <input type="text" id="descripcion" name="descripcion"
                                value="{{ old('descripcion', $areacomun->descripcion) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('descripcion') border-red-600  @enderror">
                            @error('descripcion')
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
                                    <option value="{{ $edificio->id }}" @selected($edificio->id == $areacomun->edificio->id)>
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
                            <a href="{{ route('areacomuns.index') }}">
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
