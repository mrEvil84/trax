<?php

declare(strict_types=1);

namespace Tests\Unit\Trax\Infrastructure;

use App\Car;
use App\src\Trax\Infrastructure\TraxReadModelDbRepository;
use App\src\Trax\ReadModel\Query\GetCar;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;
use Tests\TestCase;

class TraxReadModelDbRepositoryTest extends TestCase
{
    public function testGetCarWhenNotExist(): void
    {
        $queryBuilder = $this
            ->getMockBuilder(Builder::class)
            ->onlyMethods(['find'])
            ->disableOriginalConstructor()
            ->getMock();
        $queryBuilder->expects($this->once())->method('find')->willReturn(null);

        $db = $this
            ->getMockBuilder(ConnectionInterface::class)
            ->setMockClassName('DbConnection')
            ->onlyMethods(['selectOne'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $db->expects($this->once())->method('selectOne')->willReturn(null);
        $db->expects($this->once())->method('table')->willReturn($queryBuilder);

        $this->expectException(\DomainException::class);
        $sut = new TraxReadModelDbRepository($db);
        $sut->getCar(new GetCar(1,1));
    }

    public function testGetCar(): void
    {
        $queryBuilder = $this
            ->getMockBuilder(Builder::class)
            ->onlyMethods(['find'])
            ->disableOriginalConstructor()
            ->getMock();
        $queryBuilder->expects($this->exactly(0))->method('find')->willReturn(null);

        $db = $this
            ->getMockBuilder(ConnectionInterface::class)
            ->setMockClassName('DbConnection')
            ->onlyMethods(['selectOne'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $carResponse = new \stdClass();
        $carResponse->id = 1;
        $carResponse->make = 'test';
        $carResponse->model = 'testModel';
        $carResponse->year = 2022;
        $carResponse->trip_count = 2;
        $carResponse->trip_miles = 22.4;

        $db->expects($this->once())->method('selectOne')->willReturn($carResponse);
        $db->expects($this->exactly(0))->method('table')->willReturn($queryBuilder);


        $sut = new TraxReadModelDbRepository($db);
        $car = $sut->getCar(new GetCar(1,1));
        self::assertInstanceOf(Car::class, $car);
        self::assertEquals(1, $car->id);
    }
}
