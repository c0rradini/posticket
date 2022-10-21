<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'ramal' => '2133',
                'tecnico' => '1',
                'status' => '1',
                'setores_id' => Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'remember_token' => Str::random(10)
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'gab',
                'email' => 'gab@gab.com',
                'password' => Hash::make('gab'),
                'ramal' => '2133',
                'tecnico' => '0',
                'status' => '1',
                'setores_id' => Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'remember_token' => Str::random(10)
            ]
        );
    }
}
