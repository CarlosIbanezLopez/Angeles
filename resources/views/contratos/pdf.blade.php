<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
    </style>
</head>

<body background-color: blue;>
    <h2 color: red; padding: 60px;>Lista de los contratos</h2>
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


                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">Contratos no existentes</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
