<?php

namespace Database\Seeders;

use App\Models\admin\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::select('id', 'name')->whereIn('name', ['Super Admin', 'Admin', 'Sub Admin'])->get();
        $userData = [];
        foreach ($superAdmin as $key => $item) {
            $userData[] = [
                'name' => $item->name,
                'email' => DEFAULT_EMAIL[$key],
                'password' => Hash::make('12345678'),
                'role' => $item->id,
                'created_at' => formateDate(Carbon::now()),
                'updated_at' => formateDate(Carbon::now()),
            ];
        }


        User::insert($userData);
    }
}
