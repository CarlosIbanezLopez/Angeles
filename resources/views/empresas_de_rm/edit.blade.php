<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Editar Empresa de reparación o mantenimiento') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          {{-- form edit --}}
          <form action="{{ route('empresas-de-rm.update', $empresa_de_rm) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
              <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name') }}</label>
              <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $empresa_de_rm->nombre) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nombre') border-red-600  @enderror">
              @error('nombre')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="ciudad" class="block mb-2 text-sm font-medium text-gray-900">
                {{ __('City') }}
              </label>
              <select id="ciudad" name="ciudad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="PA" @selected($empresa_de_rm->ciudad == 'PA')>Pando</option>
                <option value="BE" @selected($empresa_de_rm->ciudad == 'BE')>Beni</option>
                <option value="LP" @selected($empresa_de_rm->ciudad == 'LP')>La Paz</option>
                <option value="OR" @selected($empresa_de_rm->ciudad == 'OR')>Oruro</option>
                <option value="CB" @selected($empresa_de_rm->ciudad == 'CB')>Cochabamba</option>
                <option value="SC" @selected($empresa_de_rm->ciudad == 'SC')>Santa Cruz</option>
                <option value="PO" @selected($empresa_de_rm->ciudad == 'PO')>Potosi</option>
                <option value="CH" @selected($empresa_de_rm->ciudad == 'CH')>Chuquisaca</option>
                <option value="TA" @selected($empresa_de_rm->ciudad == 'TA')>Tarija</option>
              </select>
              @error('ciudad')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Address') }}</label>
              <input type="text" id="direccion" name="direccion"
                value="{{ old('direccion', $empresa_de_rm->direccion)  }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('direccion') border-red-600  @enderror">
              @error('direccion')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Address') }}</label>
              <input type="number" id="telefono" name="telefono"
                value="{{ old('telefono', $empresa_de_rm->telefono)  }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('telefono') border-red-600  @enderror">
              @error('telefono')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-6">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Email') }}</label>
              <input type="email" id="email" name="email" value="{{ old('email', $empresa_de_rm->email)  }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-600  @enderror">
              @error('email')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex justify-between">
              <button type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
              {{ __('Update') }}
              </button>
              <a href="{{ route('empresas-de-rm.index') }}">
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