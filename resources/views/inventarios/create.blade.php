<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo mueble al inventario') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('inventarios.store') }}" method="POST">
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
                            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Estado') }}
                            </label>
                            <input type="text" id="estado" name="estado" value="{{ old('estado') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('estado') border-red-600  @enderror">
                            @error('estado')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="color" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Color') }}
                            </label>
                            <input type="text" id="color" name="color" value="{{ old('color') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('color') border-red-600  @enderror">
                            @error('color')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="id_mueble" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Mueble') }}
                            </label>
                            <select id="id_mueble" name="id_mueble"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($muebles->count() > 0)
                                    @foreach ($muebles as $mueble)
                                        <option value="{{ $mueble->id }}">{{ $mueble->codigo }}</option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar al inventario, primero debe agregar al menos un mueble') }}
                                    </option>
                                @endif
                            </select>
                            @error('id_mueble')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('inventarios.index') }}">
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
