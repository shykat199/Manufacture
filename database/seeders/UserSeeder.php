<?php

namespace Database\Seeders;

use App\Models\admin\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userRole = Role::where('name','User')->first();
        $faker = Faker::create();
        $userData = [];
        foreach (range(1,20) as $index){
            $userData[]=[
                'name'=>$faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password' =>Hash::make('password'),
                'role'=>$userRole->id,
                'updated_at'=>formateDate(Carbon::now()),
                'created_at'=>formateDate(Carbon::now())
            ];
        }

        User::insert($userData);
    }
}
