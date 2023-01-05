<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bitacoras') }}
            </h2>

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
                                        {{ __('Tabla') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Accion') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Fecha y hora') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Usuario Id') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Datos') }}
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($bitacoras->count() > 0)
                                    @foreach ($bitacoras as $bitacora)
                                        <tr class="bg-white border-b">
                                            <td class="py-2 px-2">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->id }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->tabla }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->accion }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->fecha_hora }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->id_usuario }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $bitacora->datos }}
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Bitacora vacia</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-10 mb-0">
                        {{ $bitacoras->links('pagination::tailwind') }}
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
