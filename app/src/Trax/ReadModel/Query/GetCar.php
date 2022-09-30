<?php

declare(strict_types=1);

namespace App\src\Trax\ReadModel\Query;

class GetCar extends GetQueryBase
{
    private int $carId;

    public function __construct(int $carId, int $userId)
    {
        $this->carId = $carId;
        parent::__construct($userId);
    }

    public function getCarId(): int
    {
        return $this->carId;
    }
}
