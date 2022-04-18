<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isAdmin = Role::where('name', 'admin')->first('id');
        $isCustomer = Role::where('name','user')->first('id');
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.loc',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(10),
                'role_id' => $isAdmin->id,
            ],
            [
                'name' => 'Edgar',
                'email' => 'aa@aa.aa',
                'email_verified_at' =>  Carbon::now(),
                'password' => Hash::make('aaaaaaaa'),
                'remember_token' => Str::random(10),
                'role_id' => $isCustomer->id,
            ],
        ];

        User::insert($data);


    }
}
