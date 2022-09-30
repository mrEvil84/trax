<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TripsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('trips')->insert(
            [
                [
                    'id' => 1,
                    'car_id' => 1,
                    'user_id' => 1,
                    'miles' => 11.3,
                    'total' => 45.3,
                    'date' => Carbon::now()->subDays(1),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'car_id' => 4,
                    'user_id' => 1,
                    'miles' => 12.0,
                    'total' => 34.1,
                    'date' => Carbon::now()->subDays(2),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'car_id' => 1,
                    'user_id' => 1,
                    'miles' => 6.8,
                    'total' => 22.1,
                    'date' => Carbon::now()->subDays(3),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'car_id' => 2,
                    'user_id' => 1,
                    'miles' => 5,
                    'total' => 15.3,
                    'date' => Carbon::now()->subDays(4),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'car_id' => 3,
                    'user_id' => 1,
                    'miles' => 10.3,
                    'total' => 10.3,
                    'date' => Carbon::now()->subDays(5),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            ]
        );
    }
}
