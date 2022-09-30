<?php

declare(strict_types=1);

namespace Tests\Unit\Trax\Application;

use App\src\Trax\Application\Command\AddCar;
use App\src\Trax\Application\Command\AddTrip;
use App\src\Trax\Application\TraxService;
use App\src\Trax\Infrastructure\TraxDbRepository;
use Carbon\Carbon;
use Tests\TestCase;

class TraxServiceTest extends TestCase
{
    public function testAddTripWhenCatNotExist(): void
    {
        $traxRepository = $this
            ->getMockBuilder(TraxDbRepository::class)
            ->onlyMethods(['isCarExist', 'addTrip'])
            ->disableOriginalConstructor()
            ->getMock();

        $traxRepository->expects($this->once())->method('isCarExist')->with(1)->willReturn(false);
        $traxRepository->expects($this->exactly(0))->method('addTrip');

        $this->expectException(\DomainException::class);
        $sut = new TraxService($traxRepository);
        $sut->addTrip(new AddTrip(
            1,
            new Carbon('2022-09-29 10:10:10'),
            10,
            1
        ));
    }

    public function testAddTrip(): void
    {
        $traxRepository = $this
            ->getMockBuilder(TraxDbRepository::class)
            ->onlyMethods(['isCarExist', 'addTrip'])
            ->disableOriginalConstructor()
            ->getMock();

        $traxRepository->expects($this->once())->method('isCarExist')->with(1)->willReturn(true);
        $traxRepository->expects($this->exactly(1))->method('addTrip');

        $sut = new TraxService($traxRepository);
        $sut->addTrip(new AddTrip(
            1,
            new Carbon('2022-09-29 10:10:10'),
            10,
            1
        ));
    }

    public function testAddCar(): void
    {
        $command = new AddCar(2022, 'Mercedes', 'C', 1);
        $traxRepository = $this
            ->getMockBuilder(TraxDbRepository::class)
            ->onlyMethods(['addCar'])
            ->disableOriginalConstructor()
            ->getMock();

        $traxRepository->expects($this->once())->method('addCar')->with($command);

        $sut = new TraxService($traxRepository);
        $sut->addCar(new AddCar(2022, 'Mercedes', 'C', 1));
    }

    public function testDeleteCatWhenCarNotExist(): void
    {
        $traxRepository = $this
            ->getMockBuilder(TraxDbRepository::class)
            ->onlyMethods(['isCarExist', 'deleteCar'])
            ->disableOriginalConstructor()
            ->getMock();

        $traxRepository->expects($this->once())->method('isCarExist')->with(1)->willReturn(false);
        $traxRepository->expects($this->exactly(0))->method('deleteCar');

        $this->expectException(\DomainException::class);
        $sut = new TraxService($traxRepository);
        $sut->deleteCar(1);
    }

    public function testDeleteCar(): void
    {
        $traxRepository = $this
            ->getMockBuilder(TraxDbRepository::class)
            ->onlyMethods(['isCarExist', 'deleteCar'])
            ->disableOriginalConstructor()
            ->getMock();

        $traxRepository->expects($this->once())->method('isCarExist')->with(1)->willReturn(true);
        $traxRepository->expects($this->exactly(1))->method('deleteCar');

        $sut = new TraxService($traxRepository);
        $sut->deleteCar(1);
    }
}
