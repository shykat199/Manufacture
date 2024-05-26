<?php

namespace Database\Seeders;

use App\Models\admin\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleArray = ['Super Admin', 'Admin', 'Sub Admin', 'User', 'Customer', 'Supplier', 'Manufacture'];
        $temArray = [];
        foreach ($roleArray as $item) {
            $temArray[] = [
                'name' => $item,
                'description' => null,
                'status' => ACTIVE_STATUS,
                'created_at' => formateDate(Carbon::now()),
                'updated_at' => formateDate(Carbon::now()),
            ];
        }

        Role::insert($temArray);
    }
}
