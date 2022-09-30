<?php

declare(strict_types=1);

namespace App\src\Trax\Application;

use App\src\Trax\Application\Command\AddCar;
use App\src\Trax\Application\Command\AddTrip;
use App\src\Trax\DomainModel\TraxRepository;

class TraxService
{
    private TraxRepository $repository;

    public function __construct(TraxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addCar(AddCar $command): void
    {
        $this->repository->addCar($command);
    }

    public function deleteCar(int $id): void
    {
        $this->assertCarExists($id);
        $this->repository->deleteCar($id);
    }

    public function addTrip(AddTrip $command): void
    {
        $this->assertCarExists($command->getCarId());
        $this->repository->addTrip($command);
    }

    private function assertCarExists(int $id): void
    {
        if (!$this->repository->isCarExist($id)) {
            throw new \DomainException('Car not found');
        }
    }
}
