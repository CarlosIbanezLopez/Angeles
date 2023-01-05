<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form edit --}}
                    <form action="{{ route('pagos.update', $pago) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="nro" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Nro de parqueo') }}
                            </label>
                            <input type="text" id="nro" name="nro" value="{{ old('nro', $pago->nro) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nro') border-red-600  @enderror">
                            @error('nro')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="numeropago" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Numero de pago') }}
                            </label>
                            <input type="number" id="numeropago" name="numeropago"
                                value="{{ old('numeropago', $pago->numeropago) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('numeropago') border-red-600  @enderror">
                            @error('numeropago')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="monto" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Monto cancelado') }}
                            </label>
                            <input type="number" id="monto" name="monto" value="{{ old('monto', $pago->monto) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('monto') border-red-600  @enderror">
                            @error('monto')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-6">
                            <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('fecha y hora') }}
                            </label>
                            <input type="text" id="fecha" name="fecha"
                                value="{{ old('fecha', $pago->fecha) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('fecha') border-red-600  @enderror">
                            @error('fecha')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="residente_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Residente') }}
                            </label>
                            <select id="residente_id" name="residente_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($residentes as $residente)
                                    <option value="{{ $residente->id }}" @selected($residente->id == $pago->residente->id)>
                                        {{ $residente->nombres . ' ' . $residente->apellido_paterno . ' ' . $residente->apellido_materno . ' - ' . $residente->ci }}
                                    </option>
                                @endforeach
                            </select>
                            @error('residente_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="contrato_id" class="block mb-2 text-sm font-medium text-gray-900">
                                {{ __('Contrato') }}
                            </label>
                            <select id="contrato_id" name="contrato_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($contratos as $contrato)
                                    <option value="{{ $contrato->id }}" @selected($contrato->id == $pago->contrato->id)>
                                        {{ $contrato->nro . ' - ' . $contrato->residente->nombres . ' ' . $contrato->residente->apellido_paterno . ' ' . $contrato->residente->apellido_materno . ' - ' . $contrato->precio . '' . 'Bs.' . ' - ' . $contrato->fecha_inicio . ' - ' . $contrato->fecha_final }}
                                    </option>
                                @endforeach
                            </select>
                            @error('contrato_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('pagos.index') }}">
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
