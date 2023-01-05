<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo Contrato') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}
                    <form action="{{ route('contratos.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de contrato') }}
                            </label>
                            <input type="text" id="nro" name="nro" value="{{ old('nro') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="residente_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Residente') }}
                            </label>
                            <select id="residente_id" name="residente_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($residentes->count() > 0)
                                    @foreach ($residentes as $residente)
                                        <option value="{{ $residente->id }}">
                                            {{ $residente->nombres . ' - ' . $residente->apellido_paterno . ' - ' . $residente->apellido_materno . ' - ' . $residente->nacionalidad . ' - ' . $residente->ci }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar el contrato, primero debe agregar al menos un residente') }}
                                    </option>
                                @endif
                            </select>
                            @error('residente_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="avalador_ci" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Avalador solo para residentes extranjeros') }}
                            </label>
                            <select id="avalador_ci" name="avalador_ci"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($avaladores as $avaladore)
                                    <option value="{{ $avaladore->ci }}">
                                        {{ $avaladore->nombres . ' - ' . $avaladore->apellido_paterno . ' - ' . $avaladore->apellido_materno . ' - ' . $avaladore->ci }}
                                    </option>
                                @endforeach
                            </select>
                            @error('avalador_ci')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Fecha de inicio') }}
                            </label>
                            <input type="text" id="fecha_inicio" name="fecha_inicio"
                                value="{{ old('fecha_inicio') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha_inicio') border-red-600  @enderror">
                            @error('fecha_inicio')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="fecha_final" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Fecha final') }}
                            </label>
                            <input type="text" id="fecha_final" name="fecha_final" value="{{ old('fecha_final') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha_final') border-red-600  @enderror">
                            @error('fecha_final')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="meses" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Meses de ocupacion') }}
                            </label>
                            <input type="number" id="meses" name="meses" value="{{ old('meses') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('meses') border-red-600  @enderror">
                            @error('meses')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="precio" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Precio del alquiler') }}
                            </label>
                            <input type="number" id="precio" name="precio" value="{{ old('precio') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('precio') border-red-600  @enderror">
                            @error('precio')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="descuento" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Descuento') }}
                            </label>
                            <input type="number" id="descuento" name="descuento" value="{{ old('descuento') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('descuento') border-red-600  @enderror">
                            @error('descuento')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="garantia" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Garantia') }}
                            </label>
                            <input type="number" id="garantia" name="garantia" value="{{ old('garantia') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('garantia') border-red-600  @enderror">
                            @error('garantia')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="departamento_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Departamento') }}
                            </label>
                            <select id="departamento_id" name="departamento_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @if ($departamentos->count() > 0)
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">
                                            {{ $departamento->nro . '-' . $departamento->edificio->nombre . '-' . $departamento->edificio->ciudad }}
                                        </option>
                                    @endforeach
                                @else
                                    <option>
                                        {{ __('No puede agregar el contrato, primero debe agregar al menos un departamento') }}
                                    </option>
                                @endif
                            </select>
                            @error('departamento_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="detalle" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('detalle de contrato') }}
                            </label>
                            <input type="text" id="detalle" name="detalle" value="{{ old('detalle') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('detalle') border-red-600  @enderror">
                            @error('detalle')
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

                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Save') }}
                            </button>
                            <a href="{{ route('contratos.index') }}">
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
