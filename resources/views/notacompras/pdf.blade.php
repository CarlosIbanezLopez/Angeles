<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
    <h2>Lista de las notas de compras</h2>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-2 px-2"># </th>
                <th scope="col" class="py-2 px-2">{{ __('Id') }} </th>
                <th scope="col" class="py-2 px-2">{{ __('Nro de nota de compra') }} </th>
                <th scope="col" class="py-2 px-2">{{ __('Fecha') }} </th>
                <th scope="col" class="py-2 px-2">{{ __('Provedor') }} </th>
                <th scope="col" class="py-2 px-2">{{ __('Detalle') }} </th>
                <th scope="col" class="py-2 px-2">{{ __('Muebles') }} </th>
            </tr>
        </thead>
        <tbody>
            @if ($notacompras->count() > 0)
                @foreach ($notacompras as $notacompra)
                    <tr class="bg-white border-b">
                        <td class="py-2 px-2">{{ $loop->iteration }} </td>
                        <td class="py-2 px-2">{{ $notacompra->id }} </td>
                        <td class="py-2 px-2">{{ $notacompra->nro }} </td>
                        <td class="py-2 px-2">{{ $notacompra->fecha }} </td>
                        <td class="py-2 px-2">
                            @if (isset($notacompra->proveedore->nombre))
                                {{ $notacompra->proveedore->nombre }}
                            @else
                                <p>No se ha proporcionado un Proveedor</p>
                            @endif
                        </td>
                        <td class="py-2 px-2">{{ $notacompra->detalle }} </td>
                        <td class="py-2 px-2">
                            @foreach ($notacompra->muebles as $mueble)
                                {{ $mueble->codigo }}
                                <br>
                            @endforeach
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
</body>

</html>
