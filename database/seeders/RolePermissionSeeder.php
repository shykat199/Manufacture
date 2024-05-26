<?php

namespace Database\Seeders;

use App\Models\admin\Permission;
use App\Models\admin\RolePermission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::select('id','role')->where('email',SUPER_ADMIN_EMAIL)->first();
        $allPermission = Permission::select('id')->where('status',ACTIVE_STATUS)->get();
        $superAdminRoleAndPermission = [];

        foreach ($allPermission as $key => $item) {
            $superAdminRoleAndPermission[]=[
                'role_id'=>$user->role,
                'user_id'=>$user->id,
                'permission_id'=>$item->id,
                'created_at'=>formateDate(Carbon::now()),
                'updated_at'=>formateDate(Carbon::now()),
            ];
        }

        RolePermission::insert($superAdminRoleAndPermission);
    }
}
