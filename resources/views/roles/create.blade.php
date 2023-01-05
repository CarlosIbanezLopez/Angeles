<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agregar nuevo rol') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- form create --}}


                    {!! Form::open(['route' => 'roles.store']) !!}
                    <div class="mb-6">
                        <div for="form-group" class="block mb-2 text-sm font-medium text-gray-900">

                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}

                            @error('name')
                                <small clas="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>
                        <h2 class="max-w-7xl mx-auto sm:px-6 lg:px-8">Lista de permisos</h2>
                        @foreach ($permissions as $permission)
                            <div>
                                <label>
                                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach

                        {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}

                        </h2>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
