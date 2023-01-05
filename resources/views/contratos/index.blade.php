<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Contratos') }}
            </h2>
            <a href="{{ route('contratos.create') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4"
                title="{{ __('Agregar un contrato') }}">
                <img src="{{ asset('img/plus.png') }}" alt="Agregar un contrato" class="h-auto w-6 md:w-6">
            </a>
            <a href="{{ route('contratos.pdf') }}" class="ml-4 text-sm flex justify-center items-center max-sm:w-3/4"
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
                                        {{ __('Nro contrato') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Residente') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Avalador') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Fecha de inicio') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Fecha final') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Meses') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Precio') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Descuento') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Garantia') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Departamento') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Detalle') }}
                                    </th>
                                    <th scope="col" class="py-2 px-2">
                                        {{ __('Estado') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contratos->count() > 0)
                                    @foreach ($contratos as $contrato)
                                        <tr class="bg-white border-b">
                                            <td class="py-2 px-2">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->nro }}
                                            </td>

                                            <td class="py-2 px-2">
                                                {{ $contrato->residente->nombres . ' ' . $contrato->residente->apellido_paterno . ' ' . $contrato->residente->apellido_materno . ' - ' . $contrato->residente->ci }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->avalador->nombres . ' ' . $contrato->avalador->apellido_paterno . ' ' . $contrato->avalador->apellido_materno . ' - ' . $contrato->avalador->ci }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->fecha_inicio }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->fecha_final }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->meses }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->precio }}
                                            </td>

                                            <td class="py-2 px-2">
                                                {{ $contrato->descuento }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->garantia }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->departamento->nro }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->detalle }}
                                            </td>
                                            <td class="py-2 px-2">
                                                {{ $contrato->estado }}
                                            </td>

                                            <td class="py-2 px-2 flex justify-between">
                                                <a href="{{ route('contratos.edit', $contrato) }}">
                                                    <img src="{{ asset('img/edit-button.png') }}" alt="Editar Contrato"
                                                        class="h-auto w-6 md:w-6" title="{{ __('Edit') }}">
                                                </a>
                                                <form action="{{ route('contratos.destroy', $contrato) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <img src="{{ asset('img/delete.png') }}"
                                                            alt="Eliminar contrato" class="h-auto w-6 md:w-6 tbl-hapus"
                                                            title="{{ __('Delete') }}">
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Contratos no existentes</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-10 mb-0">
                        {{ $contratos->links('pagination::tailwind') }}
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
