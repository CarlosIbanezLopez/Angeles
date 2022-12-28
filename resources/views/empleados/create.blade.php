<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Agregar nuevo Empleado') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          {{-- form create --}}
          <form action="{{ route('empleados.store') }}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="ci" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('CI') }}
              </label>
              <input type="text" id="ci" name="ci" value="{{ old('ci') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('ci') border-red-600  @enderror">
              @error('ci')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Cargo') }}
              </label>
              <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('cargo') border-red-600  @enderror">
              @error('cargo')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Nombres') }}
              </label>
              <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombres') border-red-600  @enderror">
              @error('nombres')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="apellido_paterno" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Apellido Paterno') }}
              </label>
              <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('apellido_paterno') border-red-600  @enderror">
              @error('apellido_paterno')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="apellido_materno" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Apellido Materno') }}
              </label>
              <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('apellido_materno') border-red-600  @enderror">
              @error('apellido_materno')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Sexo') }}
              </label>
              <select id="sexo" name="sexo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
              @error('sexo')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Telephone number') }}
              </label>
              <input type="number" id="telefono" name="telefono" value="{{ old('telefono') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('telefono') border-red-600  @enderror">
              @error('telefono')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Email') }}
              </label>
              <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-600  @enderror">
              @error('email')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Address') }}
              </label>
              <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('direccion') border-red-600  @enderror">
              @error('direccion')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="id_edif" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Edificio de trabajo') }}
              </label>
              <select id="id_edif" name="id_edif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if ($edificios->count() > 0)
                  @foreach ($edificios as $edificio)
                    <option value="{{ $edificio->id }}">{{ $edificio->nombre.' - '.$edificio->getCiudad() }}</option>
                  @endforeach
                @else
                  <option>{{ __('No puede agregar empleados, primero debe agregar al menos un edificio') }}</option>
                @endif
              </select>
              @error('id_edif')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex justify-between">
              <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('Save') }}
              </button>
              <a href="{{ route('empleados.index') }}">
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