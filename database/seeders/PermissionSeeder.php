<?php

namespace Database\Seeders;

use App\Models\admin\Permission;
use App\Models\admin\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionArray = ['Dashboard',
            'User','Add User','Edit User','Delete User',
            'Role','Add Role','Edit Role','Delete Role',
            'Permission','Add Permission','Edit Permission','Delete Permission',
            'Purchase','Add Purchase','Edit Purchase','Delete Purchase',
            'Customer','Add Customer','Edit Customer','Delete Customer',
            'Supplier','Add Supplier','Edit Supplier','Delete Supplier',
            'Manufacture','Add Manufacture','Edit Manufacture','Delete Manufacture',
            'Report','Add Report','Edit Report','Delete Report',
            'Order','Add Order','Edit Order','Delete Order',
            'Product','Add Product','Edit Product','Delete Product',
            'Raw Product','Add Raw Product','Edit Raw Product','Delete Raw Product',
            ];
        $permissionKeyArray=[];
        foreach ($permissionArray as $item) {
            $string = strtolower($item);
            $string = str_replace(' ', '-', $string);
            $finalSlug = preg_replace('/[^a-z0-9-]/', '', $string);
            $permissionKeyArray[]=$finalSlug;
        }


        $temArray=[];
        foreach ($permissionArray as $key => $item) {
            $temArray[]=[
                'permission_name'=>$item,
                'permission_key'=>$permissionKeyArray[$key],
                'status'=>ACTIVE_STATUS,
                'created_at'=>formateDate(Carbon::now()),
                'updated_at'=>formateDate(Carbon::now()),
            ];
        }

        Permission::insert($temArray);
    }
}
