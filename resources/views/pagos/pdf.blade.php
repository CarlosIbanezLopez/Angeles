<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
    <h2>Lista de pagos de alquiler de los residentes</h2>
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
                    {{ __('Nro de comprobante') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('Numero de pago') }}
                </th>

                <th scope="col" class="py-2 px-2">
                    {{ __('Monto cancelado') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('Fecha y hora') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('Residente') }}
                </th>
                <th scope="col" class="py-2 px-2">
                    {{ __('Contrato') }}
                </th>

            </tr>
        </thead>
        <tbody>
            @if ($pagos->count() > 0)
                @foreach ($pagos as $pago)
                    <tr class="bg-white border-b">
                        <td class="py-2 px-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->id }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->nro }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->numeropago }}
                        </td>

                        <td class="py-2 px-2">
                            {{ $pago->monto }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->fecha }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->residente->nombres . ' ' . $pago->residente->apellido_paterno . ' ' . $pago->residente->apellido_materno }}
                        </td>
                        <td class="py-2 px-2">
                            {{ $pago->contrato->nro }}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">pagos no existentes</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
