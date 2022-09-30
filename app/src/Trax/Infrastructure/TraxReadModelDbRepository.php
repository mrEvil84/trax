<?php

declare(strict_types=1);

namespace App\src\Trax\Infrastructure;

use App\Car;
use App\src\Trax\ReadModel\Query\GetCar;
use App\src\Trax\ReadModel\Query\GetCars;
use App\src\Trax\ReadModel\Query\GetTrips;
use App\src\Trax\ReadModel\TraxReadModelRepository;
use App\Trip;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Collection;

class TraxReadModelDbRepository implements TraxReadModelRepository
{
    private ConnectionInterface $db;

    public function __construct(ConnectionInterface $db) {
        $this->db = $db;
    }

    public function getCars(GetCars $query): Collection
    {
        return Car::query()->where(['user_id' => $query->getUserId()])->get();
    }

    public function getCar(GetCar $query): Car
    {
        $sql = '
        SELECT
            c.id ,
            c.make,
            c.model,
            c.year,
            count(t.id) AS trip_count,
            sum(t.miles) AS trip_miles
        FROM
            cars AS c
        JOIN
            trips t on c.id = t.car_id
        WHERE
            c.user_id = :userId AND c.id = :carId
        GROUP BY
            c.id, c.make, c.id, c.make, c.model, c.year
        ';

        $car = $this->db->selectOne($sql, ['userId' => $query->getUserId(), 'carId' => $query->getCarId()]);

        if ($car !== null) {
            return new Car([
                'id' => $car->id,
                'make' => $car->make,
                'model' => $car->model,
                'year' => $car->year,
                'trip_count' => $car->trip_count,
                'trip_miles' => $car->trip_miles,
            ]);
        }

        $car = $this->db->table('cars')->find($query->getCarId());

        if ($car === null ) {
            throw new \DomainException('No trips for car ' . $query->getCarId());
        }

        return new Car([
            'id' => $car->id,
            'make' => $car->make,
            'model' => $car->model,
            'year' => $car->year,
            'trip_count' => 0,
            'trip_miles' => 0,
        ]);
    }

    public function getTrips(GetTrips $query): Collection
    {
        return Trip::query()
            ->join('cars', 'cars.id', '=', 'trips.car_id')
            ->where(['trips.user_id' => $query->getUserId()])->get();
    }
}
