<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TripsCollection;
use App\src\Trax\Application\Command\AddTrip;
use App\src\Trax\Application\TraxService;
use App\src\Trax\ReadModel\Query\GetTrips;
use App\src\Trax\ReadModel\TraxReadModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class TripsController extends Controller
{
    private TraxReadModel $traxReadModel;
    private TraxService $traxService;

    public function __construct(TraxReadModel $traxReadModel, TraxService $traxService)
    {
        $this->traxReadModel = $traxReadModel;
        $this->traxService = $traxService;
    }

    public function getTrips(): ResourceCollection
    {
        $user = Auth::user();
        $trips = $this->traxReadModel->geTrips(new GetTrips($user->getAuthIdentifier()));
        return new TripsCollection($trips);
    }

    public function addTrip(Request $request): JsonResponse
    {
        $this->validate(
            $request,
            [
                'date' => 'required|date', // ISO 8601 string
                'car_id' => 'required|integer',
                'miles' => 'required|numeric'
            ]
        );

        $carId = (int)$request->get('car_id');
        $date = $request->get('date');
        $miles = (float)$request->get('miles');
        $user = Auth::user();

        $this->traxService->addTrip(
            new AddTrip($carId, new Carbon($date), $miles, $user->getAuthIdentifier())
        );

        return new JsonResponse(['Trip saved.']);
    }
}
