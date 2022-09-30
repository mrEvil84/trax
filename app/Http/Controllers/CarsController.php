<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\src\Trax\Application\Command\AddCar;
use App\src\Trax\Application\TraxService;
use App\src\Trax\ReadModel\Query\GetCar;
use App\src\Trax\ReadModel\Query\GetCars;
use App\src\Trax\ReadModel\TraxReadModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    private TraxReadModel $traxReadModel;
    private TraxService $traxService;

    public function __construct(TraxReadModel $traxReadModel, TraxService $traxService)
    {
        $this->traxReadModel = $traxReadModel;
        $this->traxService = $traxService;
    }

    public function getCars(): ResourceCollection
    {
        $user = Auth::user();
        $cars = $this->traxReadModel->getCars(new GetCars($user->getAuthIdentifier()));
        return new CarCollection($cars);
    }

    public function getCar(int $id): array
    {
        try {
            $user = Auth::user();
            $car = $this->traxReadModel->getCar(new GetCar($id, $user->getAuthIdentifier()));
            return ['data' => $car->toArray()];
        } catch (\DomainException $exception) {
            return [
                'data' => $exception->getMessage()
            ];
        }
    }

    public function addCar(Request $request): JsonResponse
    {
        $this->validate(
            $request,
            [
                'year' => 'required|integer',
                'make' => 'required|string',
                'model' => 'required|string',
            ]
        );

        $year = (int)$request->get('year');
        $make = $request->get('make');
        $model = $request->get('model');
        $user = Auth::user();

        $this->traxService->addCar(
            new AddCar($year, $make, $model,$user->getAuthIdentifier())
        );

        return new JsonResponse(['Car added.']);
    }

    public function deleteCar(int $id): JsonResponse
    {
        $this->traxService->deleteCar($id);

        return new JsonResponse(['Car deleted.']);
    }
}
