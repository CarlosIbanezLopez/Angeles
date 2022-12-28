<x-app-layout>
  <x-slot name="header">
    <div class="flex align-items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Residentes') }}
      </h2>
      <a href="{{ route('residentes.create') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4" title="{{ __('Agregar un residente') }}">
        <img src="{{ asset('img/plus.png') }}" alt="Agregar un residente" class="h-auto w-6 md:w-6">
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @if (session()->has('message'))
          <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <span class="font-medium"></span>{{ session('message') }}
          </div>
          @endif
          
          <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th scope="col" class="py-2 px-2">
                    #
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('ID') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('CI') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Nombres') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Apellido Paterno') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Apellido Materno') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Edad') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Sexo') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Pais de nacionalidad') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Telephone') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Email') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Options') }}
                  </th>
                </tr>
              </thead>
              <tbody>
                @if ($residentes->count() > 0)
                  @foreach ($residentes as $residente)
                  <tr class="bg-white border-b">
                    <td class="py-2 px-2">
                      {{ $loop->iteration }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->id }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->ci }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->nombres }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->apellido_paterno }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->apellido_materno }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->edad }}
                    </td>
                    <td class="py-2 px-2">
                      @if ($residente->sexo == 'M')
                        {{ __('Masculino') }}
                      @else
                        {{ __('Femenino') }}
                      @endif
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->nacionalidad }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->telefono }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $residente->email }}
                    </td>
                    <td class="py-2 px-2 flex justify-between">
                      <a href="{{ route('residentes.edit', $residente) }}">
                        <img src="{{ asset('img/edit-button.png') }}" alt="Editar residente" class="h-auto w-6 md:w-6" title="{{ __('Edit') }}">
                      </a>
                      <form action="{{ route('residentes.destroy', $residente) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                          <img src="{{ asset('img/delete.png') }}" alt="Eliminar residente" class="h-auto w-6 md:w-6 tbl-hapus" title="{{ __('Delete') }}">  
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach    
                @else
                <tr>
                  <td colspan="5" class="text-center">Residentes no existentes</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="mt-10 mb-0">
            {{ $residentes->links('pagination::tailwind') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
      const tombolHapus = document.querySelectorAll('.tbl-hapus');
      console.log(tombolHapus);
      tombolHapus.forEach(tbl => {
          tbl.addEventListener('click', function(e) {
              var form =  this.closest('form');

              e.preventDefault();
              Swal.fire({
                  title: 'Estas seguro de eliminar ?',
                  text: "Los datos eliminados no se podran recuperar !",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Eliminar !',
                  cancelButtonText: 'Cancelar'
              }).then((willDelete) => {
                  if (willDelete.value) {
                      form.submit();
                  }
              });
          });
      });
  </script>
  @endpush

</x-app-layout>