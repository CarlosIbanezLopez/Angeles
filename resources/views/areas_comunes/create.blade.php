<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Agregar nueva Area comun') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          {{-- form create --}}
          <form action="{{ route('areas-comunes.store') }}" method="POST">
            @csrf
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
                  <option>{{ __('No puede agregar areas comunes, primero debe agregar al menos un edificio') }}</option>
                @endif
              </select>
              @error('id_edif')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="id" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('ID') }}
              </label>
              <input type="number" id="id" name="id" value="{{ old('id') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('id') border-red-600  @enderror">
              @error('id')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Nombre') }}
              </label>
              <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombre') border-red-600  @enderror">
              @error('nombre')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="precio_hora" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Precio x Hora') }}
              </label>
              <input type="number" id="precio_hora" name="precio_hora" value="{{ old('precio_hora') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('precio_hora') border-red-600  @enderror">
              @error('precio_hora')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Descripción') }}
              </label>
              <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('descripcion') border-red-600  @enderror">
              @error('descripcion')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex justify-between">
              <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('Save') }}
              </button>
              <a href="{{ route('areas-comunes.index') }}">
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