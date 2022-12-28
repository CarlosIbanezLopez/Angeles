<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Editar Avalador') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          {{-- form edit --}}
          <form action="{{ route('avaladores.update', $avalador) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
              <label for="ci" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('CI') }}
              </label>
              <input type="text" id="ci" name="ci" value="{{ old('ci', $avalador->ci) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('ci') border-red-600  @enderror">
              @error('ci')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Nombres') }}
              </label>
              <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $avalador->nombres) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombres') border-red-600  @enderror">
              @error('nombres')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="apellido_paterno" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Apellido Paterno') }}
              </label>
              <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno', $avalador->apellido_paterno) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('apellido_paterno') border-red-600  @enderror">
              @error('apellido_paterno')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="apellido_materno" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Apellido Materno') }}
              </label>
              <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno', $avalador->apellido_materno) }}"
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
                <option value="M" @selected($avalador->sexo == 'M')>Masculino</option>
                <option value="F" @selected($avalador->sexo == 'F')>Femenino</option>
              </select>
              @error('sexo')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Telephone number') }}
              </label>
              <input type="number" id="telefono" name="telefono" value="{{ old('telefono', $avalador->telefono) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('telefono') border-red-600  @enderror">
              @error('telefono')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Email') }}
              </label>
              <input type="email" id="email" name="email" value="{{ old('email', $avalador->email) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-600  @enderror">
              @error('email')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('Address') }}
              </label>
              <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $avalador->direccion) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('direccion') border-red-600  @enderror">
              @error('direccion')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex justify-between">
              <button type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
              {{ __('Update') }}
              </button>
              <a href="{{ route('avaladores.index') }}">
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