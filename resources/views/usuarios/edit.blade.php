<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar un rol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="card">
                        <div class="card_body">
                            <p class="h5">Nombre:</p>
                            <p class="from-control">{{ $usuario->nombre }}</p>
                            <h2 class="h5">Listado de roles></h2>
                            {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario], 'method' => 'put']) !!}
                            @foreach ($roles as $role)
                                <div>
                                    <label>
                                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                            {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>

                    {{-- form edit --}}







                </div>
            </div>
        </div>
</x-app-layout>
