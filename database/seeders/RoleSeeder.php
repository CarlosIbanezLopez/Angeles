<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Residente']);

        Permission::create(['name' => 'residente.home']);
        Permission::create(['name' => 'residente.pagos.index']);
        Permission::create(['name' => 'residente.residentes.index']);
        Permission::create(['name' => 'residente.avaladores.index']);
        Permission::create(['name' => 'residente.empleados.index']);
        Permission::create(['name' => 'residente.notaservicios.index']);
        Permission::create(['name' => 'residente.edificios.index']);
        Permission::create(['name' => 'residente.departamentos.index']);
        Permission::create(['name' => 'residente.areacomuns.index']);
        Permission::create(['name' => 'residente.parqueos.index']);
        Permission::create(['name' => 'residente.muebles.index']);
        Permission::create(['name' => 'residente.inventarios.index']);
        Permission::create(['name' => 'residente.categorias.index']);
        Permission::create(['name' => 'residente.marcas.index']);
        Permission::create(['name' => 'residente.notasalidas.index']);

        Permission::create(['name' => 'admin.home']);

        Permission::create(['name' => 'admin.pagos.index']);
        Permission::create(['name' => 'admin.pagos.create']);
        Permission::create(['name' => 'admin.pagos.edit']);
        Permission::create(['name' => 'admin.pagos.delete']);

        Permission::create(['name' => 'admin.contratos.index']);
        Permission::create(['name' => 'admin.contratos.create']);
        Permission::create(['name' => 'admin.contratos.edit']);
        Permission::create(['name' => 'admin.contratos.delete']);

        Permission::create(['name' => 'admin.residentes.index']);
        Permission::create(['name' => 'admin.residentes.create']);
        Permission::create(['name' => 'admin.residentes.edit']);
        Permission::create(['name' => 'admin.residentes.delete']);

        Permission::create(['name' => 'admin.avaladores.index']);
        Permission::create(['name' => 'admin.avaladores.create']);
        Permission::create(['name' => 'admin.avaladores.edit']);
        Permission::create(['name' => 'admin.avaladores.delete']);

        Permission::create(['name' => 'admin.bitacora.index']);

        Permission::create(['name' => 'admin.empleados.index']);
        Permission::create(['name' => 'admin.empleados.create']);
        Permission::create(['name' => 'admin.empleados.edit']);
        Permission::create(['name' => 'admin.empleados.delete']);

        Permission::create(['name' => 'admin.notacompras.index']);
        Permission::create(['name' => 'admin.notacompras.create']);
        Permission::create(['name' => 'admin.notacompras.edit']);
        Permission::create(['name' => 'admin.notacompras.delete']);

        Permission::create(['name' => 'admin.notaservicios.index']);
        Permission::create(['name' => 'admin.notaservicios.create']);
        Permission::create(['name' => 'admin.notaservicios.edit']);
        Permission::create(['name' => 'admin.notaservicios.delete']);

        Permission::create(['name' => 'admin.proveedores.index']);
        Permission::create(['name' => 'admin.proveedores.create']);
        Permission::create(['name' => 'admin.proveedores.edit']);
        Permission::create(['name' => 'admin.proveedores.delete']);

        Permission::create(['name' => 'admin.empresas_de_rm.index']);
        Permission::create(['name' => 'admin.empresas_de_rm.create']);
        Permission::create(['name' => 'admin.empresas_de_rm.edit']);
        Permission::create(['name' => 'admin.empresas_de_rm.delete']);

        Permission::create(['name' => 'admin.trabajadores_de_rm.index']);
        Permission::create(['name' => 'admin.trabajadores_de_rm.create']);
        Permission::create(['name' => 'admin.trabajadores_de_rm.edit']);
        Permission::create(['name' => 'admin.trabajadores_de_rm.delete']);

        Permission::create(['name' => 'admin.edificios.index']);
        Permission::create(['name' => 'admin.edificios.create']);
        Permission::create(['name' => 'admin.edificios.edit']);
        Permission::create(['name' => 'admin.edificios.delete']);

        Permission::create(['name' => 'admin.departamentos.index']);
        Permission::create(['name' => 'admin.departamentos.create']);
        Permission::create(['name' => 'admin.departamentos.edit']);
        Permission::create(['name' => 'admin.departamentos.delete']);

        Permission::create(['name' => 'admin.areacomuns.index']);
        Permission::create(['name' => 'admin.areacomuns.create']);
        Permission::create(['name' => 'admin.areacomuns.edit']);
        Permission::create(['name' => 'admin.areacomuns.delete']);

        Permission::create(['name' => 'admin.parqueos.index']);
        Permission::create(['name' => 'admin.parqueos.create']);
        Permission::create(['name' => 'admin.parqueos.edit']);
        Permission::create(['name' => 'admin.parqueos.delete']);

        Permission::create(['name' => 'admin.muebles.index']);
        Permission::create(['name' => 'admin.muebles.create']);
        Permission::create(['name' => 'admin.muebles.edit']);
        Permission::create(['name' => 'admin.muebles.delete']);

        Permission::create(['name' => 'admin.inventarios.index']);
        Permission::create(['name' => 'admin.inventarios.create']);
        Permission::create(['name' => 'admin.inventarios.edit']);
        Permission::create(['name' => 'admin.inventarios.delete']);

        Permission::create(['name' => 'admin.categorias.index']);
        Permission::create(['name' => 'admin.categorias.create']);
        Permission::create(['name' => 'admin.categorias.edit']);
        Permission::create(['name' => 'admin.categorias.delete']);

        Permission::create(['name' => 'admin.marcas.index']);
        Permission::create(['name' => 'admin.marcas.create']);
        Permission::create(['name' => 'admin.marcas.edit']);
        Permission::create(['name' => 'admin.marcas.delete']);

        Permission::create(['name' => 'admin.notasalidas.index']);
        Permission::create(['name' => 'admin.notasalidas.create']);
        Permission::create(['name' => 'admin.notasalidas.edit']);
        Permission::create(['name' => 'admin.notasalidas.delete']);



    }
}
