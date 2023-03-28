<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    
    {
        //Roles
        $customer = Role::create(['name' => 'customer']);
        $admin = Role::create(['name' => 'admin']);
        
        //Permisos de Usuarios
        $index_users = Permission::create(['name' => 'show all users']);
        $show_user = Permission::create(['name' => 'show user']);
        $edit_user = Permission::create(['name' => 'edit user']);
        $create_user = Permission::create(['name' => 'create user']);
        $delete_user = Permission::create(['name' => 'delete user']);
        
        //Permisos de Ventas
        $index_sales = Permission::create(['name' => 'show all sales']);
        $show_sales_by_user = Permission::create(['name' => 'show sales by user']);
        $show_Sale = Permission::create(['name' => 'show sale']);
        $paid_sale = Permission::create(['name' => 'paid_sale']);
        $create_sale = Permission::create(['name' => 'create_sale']);

        //Permisos sobre fragancias
        $index_fragances = Permission::create(['name' => 'show all fragances']);
        $show_fragance = Permission::create(['name' => 'show fragance']);
        $edit_fragance = Permission::create(['name' => 'edit fragance']);
        $create_fragance = Permission::create(['name' => 'create fragance']);
        $delete_fragance = Permission::create(['name' => 'delete fragance']);

        //Permisos sobre tabla clientes
        $index_customers = Permission::create(['name' => 'show all customers']);
        $show_customer = Permission::create(['name' => 'show customer']);
        $edit_customer = Permission::create(['name' => 'edit customer']);
        $create_customer = Permission::create(['name' => 'create customer']);
        $delete_customer = Permission::create(['name' => 'delete customer']);


        //Permisos sobre Pagos
        $index_payments = Permission::create(['name' => 'show all payments']);
        $show_payment = Permission::create(['name' => 'show payment']);
        $create_payment = Permission::create(['name' => 'create payment']);
 


        $admin->givePermissionTo([
            $index_users,
            $show_sales_by_user,$show_Sale,$index_sales,
            $index_fragances,$show_fragance,$edit_fragance,$create_fragance,$delete_fragance,
            $index_customers,$show_customer,$edit_customer,$create_customer,
            $index_payments,$show_payment
        ]);

        $customer->givePermissionTo([
            $show_user,$edit_user,$create_user,$delete_user,
            $show_sales_by_user,$show_Sale,$paid_sale,$create_sale,
            $show_customer,$edit_customer,$create_customer,$delete_customer,
            $show_payment,$create_payment
        ]);

        $super_admin = Role::create(['name'=>'super-Admin']);

        $super_admin->givePermissionTo(Permission::all());




    }
}
