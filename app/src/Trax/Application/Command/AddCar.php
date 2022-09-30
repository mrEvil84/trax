<?php

declare(strict_types=1);

namespace App\src\Trax\Application\Command;

class AddCar extends CommandBase
{
    private int $year;
    private string $make;
    private string $model;

    public function __construct(int $year, string $make, string $model, int $userId)
    {
        $this->year = $year;
        $this->make = $make;
        $this->model = $model;
        parent::__construct($userId);
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }
}
