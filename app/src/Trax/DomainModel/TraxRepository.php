<?php

declare(strict_types=1);

namespace App\src\Trax\DomainModel;

use App\src\Trax\Application\Command\AddCar;
use App\src\Trax\Application\Command\AddTrip;

interface TraxRepository
{
    public function addCar(AddCar $command): void;

    public function isCarExist(int $id): bool;

    public function deleteCar(int $id): void;

    public function addTrip(AddTrip $command): void;
}
