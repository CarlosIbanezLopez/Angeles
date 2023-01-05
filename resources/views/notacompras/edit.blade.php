<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Nota de compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form edit --}}
                    <form action="{{ route('notacompras.update', $notacompra) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de nota de compra') }}
                            </label>
                            <input type="text" id="nro" name="nro"
                                value="{{ old('nro', $notacompra->nro) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="from-group">
                            <label for="mueble_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Muebles') }}
                            </label>
                            <select id="mueble_id" name="mueble_id[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                multiple required>
                                @foreach ($muebles as $mueble)
                                    <option value="{{ $mueble->id }}"
                                        {{ in_array($mueble->id, old('muebles', $notacompra->muebles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $mueble->codigo . '-' . $mueble->precio }}
                                    </option>
                                @endforeach





                            </select>
                            @error('mueble_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Detalle') }}
                            </label>
                            <input type="text" id="detalle" name="detalle"
                                value="{{ old('detalle', $notacompra->detalle) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('detalle') border-red-600  @enderror">
                            @error('detalle')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Fecha') }}
                            </label>
                            <input type="text" id="fecha" name="fecha"
                                value="{{ old('fecha', $notacompra->fecha) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha') border-red-600  @enderror">
                            @error('fecha')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="provedor_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Edificio de trabajo') }}
                            </label>
                            <select id="provedor_id" name="provedor_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($provedores as $provedore)
                                    <option value="{{ $provedore->id }}" @selected($provedore->id == $notacompra->proveedore->id)>
                                        {{ $provedore->nombre . ' - ' . $provedore->getCiudad() }}</option>
                                @endforeach
                            </select>
                            @error('provedor_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('notacompras.index') }}">
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
