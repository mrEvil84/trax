<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'piotr',
                    'email' => 'piotr.kowerzanow@gmail.com',
                    'password' => '$2y$10$WSYX5VCekFit6ijiKPJu2eM11w9UW5ZEZV4juKb1dy7/LPEzBpPym',
                    'remember_token' => null,
                    'created_at' => '2022-09-28 19:35:18.0',
                    'updated_at' => '2022-09-28 19:35:18.0',
                ],
            ]
        );
    }
}

