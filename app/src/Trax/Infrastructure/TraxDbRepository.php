<?php

declare(strict_types=1);

namespace App\src\Trax\Infrastructure;

use App\Car;
use App\src\Trax\Application\Command\AddCar;
use App\src\Trax\Application\Command\AddTrip;
use App\src\Trax\DomainModel\TraxRepository;
use App\Trip;
use Illuminate\Database\ConnectionInterface;

class TraxDbRepository implements TraxRepository
{
    private ConnectionInterface $db;

    public function __construct(ConnectionInterface $db) {
        $this->db = $db;
    }

    public function addCar(AddCar $command): void
    {
        $car = new Car();
        $car->year = $command->getYear();
        $car->make = $command->getMake();
        $car->model = $command->getModel();
        $car->user_id = $command->getUserId();
        $car->save();
    }

    public function isCarExist(int $id): bool
    {
        return Car::query()->find($id) !== null;
    }

    public function deleteCar(int $id): void
    {
        $car = Car::query()->find($id);
        $car->delete();
    }

    public function addTrip(AddTrip $command): void
    {
        $trip = new Trip();
        $trip->car_id = $command->getCarId();
        $trip->user_id = $command->getUserId();
        $trip->miles = $command->getMiles();
        $trip->date = $command->getDate();
        $trip->total = $this->getTotalMiles($command->getCarId(), $command->getMiles());
        $trip->save();
    }

    private function getTotalMiles(int $carId, float $tripMiles): float
    {
        $sql = '
         SELECT
            sum(t.miles) AS miles
         FROM
             trips AS t
         WHERE t.car_id = :carId;
        ';

        $miles = $this->db->selectOne($sql, ['carId' => $carId]);
        if ($miles === null) {
            $miles = 0;
        }

        return $miles->miles + $tripMiles;
    }
}
