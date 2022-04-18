<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user',
            ]
        ];

        Role::insert($data);
    }
}
