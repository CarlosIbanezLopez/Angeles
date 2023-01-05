<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo Mueble') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('muebles.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Codigo') }}
                            </label>
                            <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('codigo') border-red-600  @enderror">
                            @error('codigo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Categoria') }}
                            </label>
                            <select id="categoria_id" name="categoria_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($categorias->count() > 0)
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar Mueble, primero debe agregar al menos una categoria') }}
                                    </option>
                                @endif
                            </select>
                            @error('categoria_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="marca_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Marca') }}
                            </label>
                            <select id="marca_id" name="marca_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($marcas->count() > 0)
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar Mueble, primero debe agregar al menos una marca') }}
                                    </option>
                                @endif
                            </select>
                            @error('marca_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('descripcion') }}
                            </label>
                            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('descripcion') border-red-600  @enderror">
                            @error('descripcion')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Precio') }}
                            </label>
                            <input type="number" id="precio" name="precio" value="{{ old('precio') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('precio') border-red-600  @enderror">
                            @error('precio')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="colores" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Colores') }}
                            </label>
                            <input type="number" id="colores" name="colores" value="{{ old('colores') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('colores') border-red-600  @enderror">
                            @error('colores')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('muebles.index') }}">
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
