<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nueva nota de servicio') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('notaservicios.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de nota de servcio') }}
                            </label>
                            <input type="text" id="nro" name="nro" value="{{ old('nro') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="motivo" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Motivo') }}
                            </label>
                            <input type="text" id="motivo" name="motivo" value="{{ old('motivo') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('motivo') border-red-600  @enderror">
                            @error('motivo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Detalle') }}
                            </label>
                            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('descripcion') border-red-600  @enderror">
                            @error('descripcion')
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
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Total a cancelar') }}
                            </label>
                            <input type="text" id="total" name="total" value="{{ old('total') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('total') border-red-600  @enderror">
                            @error('total')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="trabajador_ci" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Trabajadore que realizo el servicio o empresa') }}
                            </label>
                            <select id="trabajador_ci" name="trabajador_ci"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($trabajadores->count() > 0)
                                    @foreach ($trabajadores as $trabajadore)
                                        <option value="{{ $trabajadore->ci }}">
                                            {{ $trabajadore->nombres . ' ' . $trabajadore->apellido_materno . ' ' . $trabajadore->apellido_paterno . ' - ' . $trabajadore->ci }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar el pago, primero debe agregar al trabajador de servicios') }}
                                    </option>
                                @endif
                            </select>
                            @error('trabajador_ci')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="empresa_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Empresa') }}
                            </label>
                            <select id="empresa_id" name="empresa_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                @if ($empresas->count() > 0)
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">
                                            {{ $empresa->nombre . ' ' . $empresa->ciudad }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar el nota de contrato, primero debe agregar al menos una empresa de servicio') }}
                                    </option>
                                @endif
                            </select>
                            @error('empresa_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="edificio_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Edificio') }}
                            </label>
                            <select id="edificio_id" name="edificio_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                @if ($edificios->count() > 0)
                                    @foreach ($edificios as $edificio)
                                        <option value="{{ $edificio->id }}">
                                            {{ $edificio->nombre . ' ' . $edificio->ciudad }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar el nota de contrato, primero debe agregar al menos una empresa de servicio') }}
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
                            <a href="{{ route('notaservicios.index') }}">
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
