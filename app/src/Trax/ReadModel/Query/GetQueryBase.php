<?php

declare(strict_types=1);


namespace App\src\Trax\ReadModel\Query;


abstract class GetQueryBase
{
    private int $id;

    public function __construct(int $userId)
    {
        $this->id = $userId;
    }

    public function getUserId(): int
    {
        return $this->id;
    }
}
