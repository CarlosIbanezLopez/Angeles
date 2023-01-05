<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nueva Nota de compra') }}
            </h2>
        </div>
    </x-slot>
    @section('styles')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    @endsection
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('notacompras.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de nota') }}
                            </label>
                            <input type="text" id="nro" name="nro" value="{{ old('nro') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label for="mueble_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Muebles') }}
                            </label>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="mueble_id[]" id="mueble_id" multiple required>
                                @foreach ($muebles as $mueble)
                                    <option value="{{ $mueble->id }}">
                                        {{ $mueble->codigo . '-' . $mueble->precio }}</option>
                                @endforeach

                            </select>
                            @error('mueble_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('detalle') }}
                            </label>
                            <input type="text" id="detalle" name="detalle" value="{{ old('detalle') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('detalle') border-red-600  @enderror">
                            @error('detalle')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('fecha') }}
                            </label>
                            <input type="text" id="fecha" name="fecha" value="{{ old('fecha') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha') border-red-600  @enderror">
                            @error('fecha')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="provedor_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Proveedores') }}
                            </label>
                            <select id="provedor_id" name="provedor_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($provedores->count() > 0)
                                    @foreach ($provedores as $provedore)
                                        <option value="{{ $provedore->id }}">{{ $provedore->nombre }}</option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar Nota de compra, primero debe agregar al menos un proveedor') }}
                                    </option>
                                @endif
                            </select>
                            @error('provedor_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>





                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Save') }}
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
    @section('scripts')
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    @endsection
</x-app-layout>
