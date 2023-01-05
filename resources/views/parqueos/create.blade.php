<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo Parqueo') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('parqueos.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de parqueo') }}
                            </label>
                            <input type="text" id="nro" name="nro" value="{{ old('nro') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="piso" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Piso') }}
                            </label>
                            <input type="number" id="piso" name="piso" value="{{ old('piso') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('piso') border-red-600  @enderror">
                            @error('piso')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Detalle') }}
                            </label>
                            <input type="text" id="detalle" name="detalle" value="{{ old('detalle') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('detalle') border-red-600  @enderror">
                            @error('detalle')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="departamento_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Departamento al que pertenece') }}
                            </label>
                            <select id="departamento_id" name="departamento_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($departamentos->count() > 0)
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">
                                            {{ $departamento->nro . ' - ' . $departamento->edificio->nombre . '-' . $departamento->edificio->ciudad }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar departamento, primero debe agregar al menos un departamento') }}
                                    </option>
                                @endif
                            </select>
                            @error('edificio_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="edificio_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Edificio al que pertenece') }}
                            </label>
                            <select id="edificio_id" name="edificio_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($edificios->count() > 0)
                                    @foreach ($edificios as $edificio)
                                        <option value="{{ $edificio->id }}">
                                            {{ $edificio->nombre . ' - ' . $edificio->getCiudad() }}</option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar departamento, primero debe agregar al menos un edificio') }}
                                    </option>
                                @endif
                            </select>
                            @error('edificio_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('parqueos.index') }}">
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
