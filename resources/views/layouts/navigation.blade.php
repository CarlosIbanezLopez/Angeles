<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                        <x-slot name="name">Servicios</x-slot>
                        <x-slot name="children">
                            <a href="{{ route('pagos.index') }}">Pagos de alquileres</a>

                            <span class="separator"></span>
                            @can('admin.contratos.index')
                                <a href="{{ route('contratos.index') }}">Contratos</a>
                            @endcan
                            <a href="{{ route('residentes.index') }}">Residentes</a>
                            <a href="{{ route('avaladores.index') }}">Avaladores</a>
                            <span class="separator"></span>
                            @can('admin.contratos.index')
                                <a href="{{ route('roles.index') }}">Roles</a>
                            @endcan
                            @can('admin.bitacora.index')
                                <a href="{{ route('bitacoras.index') }}">Bitacora</a>
                            @endcan
                            @can('admin.contratos.index')
                                <a href="{{ route('usuarios.index') }}">Usuarios</a>
                            @endcan
                            <a href="{{ route('empleados.index') }}">Empleados</a>
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>

                        </x-slot>
                    </x-nav-link-parent>
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                        <x-slot name="name">Compras</x-slot>
                        <x-slot name="children">
                            @can('admin.notacompras.index')
                                <a href="{{ route('notacompras.index') }}">Notas de Compra</a>
                            @endcan
                            <a href="{{ route('notaservicios.index') }}">Notas de servicio</a>
                            <span class="separator"></span>
                            @can('admin.proveedores.index')
                                <a href="{{ route('proveedores.index') }}">Proveedores</a>
                            @endcan
                            @can('admin.empresas_de_rm..index')
                                <a href="{{ route('empresas-de-rm.index') }}">Empresas RM</a>
                            @endcan
                            @can('admin.trabajadores_de_rm.index')
                                <a href="{{ route('trabajadores-de-rm.index') }}">Trabajadores RM</a>
                            @endcan
                        </x-slot>
                    </x-nav-link-parent>
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                        <x-slot name="name">Espacios</x-slot>
                        <x-slot name="children">
                            <a href="{{ route('edificios.index') }}">Edificios</a>
                            <a href="{{ route('departamentos.index') }}">Departamentos</a>
                            <span class="separator"></span>
                            <a href="{{ route('areacomuns.index') }}">Areas Comunes</a>
                            <a href="{{ route('parqueos.index') }}">Parqueos</a>
                        </x-slot>
                    </x-nav-link-parent>
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                        <x-slot name="name">Inventario</x-slot>
                        <x-slot name="children">
                            @can('admin.muebles.index')
                                <a href="{{ route('muebles.index') }}">Muebles</a>
                            @endcan
                            @can('admin.inventarios.index')
                                <a href="{{ route('inventarios.index') }}">Muebles del inventario</a>
                            @endcan
                            @can('admin.categorias.index')
                                <a href="{{ route('categorias.index') }}">Categorias</a>
                            @endcan
                            @can('admin.marcas..index')
                                <a href="{{ route('marcas.index') }}">Marcas</a>
                            @endcan
                            <span class="separator"></span>
                            @can('admin.notasalidas.index')
                                <a href="{{ route('notasalidas.index') }}">Notas de salida</a>
                            @endcan
                        </x-slot>
                    </x-nav-link-parent>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nombre }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                <x-slot name="name">Servicios</x-slot>
                <x-slot name="children">
                    <a href="{{ route('pagos.index') }}">Pagos de alquileres</a>

                    <span class="separator"></span>
                    @can('admin.contratos.index')
                        <a href="{{ route('contratos.index') }}">Contratos</a>
                    @endcan
                    <a href="{{ route('residentes.index') }}">Residentes</a>
                    <a href="{{ route('avaladores.index') }}">Avaladores</a>
                    <span class="separator"></span>
                    <a href="{{ route('roles.index') }}">Roles</a>
                    @can('admin.bitacora.index')
                        <a href="{{ route('bitacoras.index') }}">Bitacora</a>
                    @endcan
                    @can('admin.contratos.index')
                        <a href="{{ route('usuarios.index') }}">Usuarios</a>
                    @endcan
                    <a href="{{ route('empleados.index') }}">Empleados</a>
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>

                </x-slot>
            </x-responsive-nav-link-parent>
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                <x-slot name="name">Compras</x-slot>
                <x-slot name="children">
                    @can('admin.notacompras.index')
                        <a href="{{ route('notacompras.index') }}">Notas de Compra</a>
                    @endcan
                    <a href="{{ route('notaservicios.index') }}">Notas de servicio</a>
                    <span class="separator"></span>
                    @can('admin.proveedores.index')
                        <a href="{{ route('proveedores.index') }}">Proveedores</a>
                    @endcan
                    @can('admin.empresas_de_rm.index')
                        <a href="{{ route('empresas-de-rm.index') }}">Empresas RM</a>
                    @endcan

                    @can('admin.trabajadores_de_rm.index')
                        <a href="{{ route('trabajadores-de-rm.index') }}">Trabajadores RM</a>
                    @endcan

                </x-slot>
            </x-responsive-nav-link-parent>
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                <x-slot name="name">Espacios</x-slot>
                <x-slot name="children">
                    <a href="{{ route('edificios.index') }}">Edificios</a>
                    <a href="{{ route('departamentos.index') }}">Departamentos</a>
                    <span class="separator"></span>
                    <a href="{{ route('areacomuns.index') }}">Areas Comunes</a>
                    <a href="{{ route('parqueos.index') }}">Parqueos</a>
                </x-slot>
            </x-responsive-nav-link-parent>
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('padron.*')">
                <x-slot name="name">Inventario</x-slot>
                <x-slot name="children">
                    @can('admin.muebles.index')
                        <a href="{{ route('muebles.index') }}">Muebles</a>
                    @endcan
                    @can('admin.inventarios.index')
                        <a href="{{ route('inventarios.index') }}">Muebles del inventario</a>
                    @endcan
                    @can('admin.categorias.index')
                        <a href="{{ route('categorias.index') }}">Categorias</a>
                    @endcan
                    @can('admin.marcas.index')
                        <a href="{{ route('marcas.index') }}">Marcas</a>
                    @endcan
                    <span class="separator"></span>
                    @can('admin.notasalidas.index')
                        <a href="{{ route('notasalidas.index') }}">Notas de salida</a>
                    @endcan
                </x-slot>
            </x-responsive-nav-link-parent>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->nombre }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
