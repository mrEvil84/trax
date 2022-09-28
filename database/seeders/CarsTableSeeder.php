<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cars')->insert(
          [
              [
                  'make' => 'Land Rover',
                  'model' => 'Range Rover Sport',
                  'year' => 2017,
                  'user_id' => 1,
                  'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                  'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
              ],
              [
                  'make' => 'Ford',
                  'model' => 'F150',
                  'year' => 2014,
                  'user_id' => 1,
                  'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                  'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
              ],
              [
                  'make' => 'Chevy',
                  'model' => 'Tahoe',
                  'year' => 2015,
                  'user_id' => 1,
                  'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                  'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
              ],
              [
                  'make' => 'Aston Martin',
                  'model' => 'Vanquish',
                  'year' => 2018,
                  'user_id' => 1,
                  'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                  'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
              ],
          ]
        );
    }
}

