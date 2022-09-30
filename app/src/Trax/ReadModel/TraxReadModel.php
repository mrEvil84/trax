<?php

declare(strict_types=1);

namespace App\src\Trax\ReadModel;

use App\Car;
use App\src\Trax\ReadModel\Query\GetCar;
use App\src\Trax\ReadModel\Query\GetCars;
use App\src\Trax\ReadModel\Query\GetTrips;
use Illuminate\Database\Eloquent\Collection;

class TraxReadModel
{
    private TraxReadModelRepository $traxReadModelRepository;

    public function __construct(TraxReadModelRepository $traxReadModelRepository)
    {
        $this->traxReadModelRepository = $traxReadModelRepository;
    }
    public function getCars(GetCars $query): Collection
    {
        return $this->traxReadModelRepository->getCars($query);
    }

    public function getCar(GetCar $query): Car
    {
        return $this->traxReadModelRepository->getCar($query);
    }

    public function geTrips(GetTrips $query): Collection
    {
        return $this->traxReadModelRepository->getTrips($query);
    }

}
