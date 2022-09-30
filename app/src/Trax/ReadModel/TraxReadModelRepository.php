<?php

namespace App\src\Trax\ReadModel;

use App\Car;
use App\src\Trax\ReadModel\Query\GetCar;
use App\src\Trax\ReadModel\Query\GetCars;
use App\src\Trax\ReadModel\Query\GetTrips;
use Illuminate\Database\Eloquent\Collection;

interface TraxReadModelRepository
{
    public function getCars(GetCars $query): Collection;
    public function getCar(GetCar $query): Car;
    public function getTrips(GetTrips $query): Collection;

}
