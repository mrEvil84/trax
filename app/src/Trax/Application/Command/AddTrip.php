<?php

declare(strict_types=1);

namespace App\src\Trax\Application\Command;

use Carbon\Carbon;

class AddTrip extends CommandBase
{
    private int $carId;
    private Carbon $date;
    private float $miles;

    public function __construct(int $carId, Carbon $date, float $miles, int $userId)
    {
        $this->carId = $carId;
        $this->date = $date;
        $this->miles = $miles;
        parent::__construct($userId);
    }

    public function getCarId(): int
    {
        return $this->carId;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function getMiles(): float
    {
        return $this->miles;
    }
}
