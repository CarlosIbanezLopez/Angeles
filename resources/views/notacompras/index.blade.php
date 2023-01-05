<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nota de compras') }}
            </h2>
            <a href="{{ route('notacompras.create') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4"
                title="{{ __('Agregar una nota de compra') }}">
                <img src="{{ asset('img/plus.png') }}" alt="Agregar una nota de compra" class="h-auto w-6 md:w-6">
            </a>
            <a href="{{ route('notacompras.pdf') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4"
                title="{{ __('PDF') }}">
                <img src="{{ asset('pdf') }}" alt="PDF" class="h-auto w-6 md:w-6">
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
                                        {{ __('Id') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Nro de nota de compra') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Fecha') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Provedor') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Detalle') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Muebles') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($notacompras->count() > 0)
                                    @foreach ($notacompras as $notacompra)
                                        <tr class="bg-white border-b">
                                            <td class="py-2 px-2">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $notacompra->id }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $notacompra->nro }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $notacompra->fecha }}
                                            </td>


                                            <td class="py-2 px-2">
                                                @if (isset($notacompra->proveedore->nombre))
                                                    {{ $notacompra->proveedore->nombre }}
                                                @else
                                                    <p>No se ha proporcionado un Proveedor</p>
                                                @endif
                                            </td>


                                            <td class="py-2 px-2">
                                                {{ $notacompra->detalle }}
                                            </td>

                                            <td class="py-2 px-2">
                                                @foreach ($notacompra->muebles as $mueble)
                                                    {{ $mueble->codigo }}<br>
                                                @endforeach
                                            </td>





                                            <td class="py-2 px-2 flex justify-between">
                                                <a href="{{ route('notacompras.edit', $notacompra) }}">
                                                    <img src="{{ asset('img/edit-button.png') }}"
                                                        alt="Editar nota de compra" class="h-auto w-6 md:w-6"
                                                        title="{{ __('Edit') }}">
                                                </a>
                                                <form action="{{ route('notacompras.destroy', $notacompra) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <img src="{{ asset('img/delete.png') }}"
                                                            alt="Eliminar nota de comopra"
                                                            class="h-auto w-6 md:w-6 tbl-hapus"
                                                            title="{{ __('Delete') }}">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Notas de compras no existentes</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-10 mb-0">
                        {{ $notacompras->links('pagination::tailwind') }}
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
                    var form = this.closest('form');

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
