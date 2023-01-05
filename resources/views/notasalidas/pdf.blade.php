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
    <h2 color: red; padding: 60px;>Lista de las notas de Notas de salida</h2>
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
                    {{ __('Nro de nota de salida') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('motivo') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('Muebles que se retiraron del inventario') }}
                </th>

            </tr>
        </thead>
        <tbody>
            @if ($notasalidas->count() > 0)
                @foreach ($notasalidas as $notasalida)
                    <tr class="bg-white border-b">
                        <td class="py-2 px-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $notasalida->id }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $notasalida->nro }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $notasalida->motivo }}
                        </td>
                        <td class="py-2 px-2">
                            @foreach ($notasalida->inventarios as $inventario)
                                {{ $inventario->codigo }}<br>
                            @endforeach
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">nota de salidas no existentes</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
