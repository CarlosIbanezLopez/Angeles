<x-app-layout>
  <x-slot name="header">
    <div class="flex align-items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Categorias') }}
      </h2>
      <a href="{{ route('categorias.create') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4" title="{{ __('Agregar una categoria') }}">
        <img src="{{ asset('img/plus.png') }}" alt="Agregar categoria" class="h-auto w-6 md:w-6">
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
                    {{ __('Name') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Descripcion') }}
                  </th>
                  <th scope="col" class="py-2 px-2">
                    {{ __('Options') }}
                  </th>
                </tr>
              </thead>
              <tbody>
                @if ($categorias->count() > 0)
                  @foreach ($categorias as $categoria)
                  <tr class="bg-white border-b">
                    <td class="py-2 px-3">
                      {{ $loop->iteration }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $categoria->nombre }}
                    </td>
                    <td class="py-2 px-2">
                      {{ $categoria->descripcion }}
                    </td>
                    
                    <td class="py-2 px-2 flex justify-between">
                      <a href="{{ route('categorias.edit', $categoria) }}">
                        <img src="{{ asset('img/edit-button.png') }}" alt="Editar categoria" class="h-auto w-6 md:w-6" title="{{ __('Edit') }}">
                      </a>
                      <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                          <img src="{{ asset('img/delete.png') }}" alt="Eliminar categoria" class="h-auto w-6 md:w-6 tbl-hapus" title="{{ __('Delete') }}">  
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach    
                @else
                <tr>
                  <td colspan="5" class="text-center">Categorias no existentes</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="mt-10 mb-0">
            {{ $categorias->links('pagination::tailwind') }}
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