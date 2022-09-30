<?php

declare(strict_types=1);

namespace App\Providers;

use App\src\Trax\Application\TraxService;
use App\src\Trax\DomainModel\TraxRepository;
use App\src\Trax\Infrastructure\TraxDbRepository;
use App\src\Trax\Infrastructure\TraxReadModelDbRepository;
use App\src\Trax\ReadModel\TraxReadModel;
use App\src\Trax\ReadModel\TraxReadModelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class TraxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TraxReadModel::class, function ($app) {
            return new TraxReadModel(
                resolve(TraxReadModelRepository::class)
            );
        });

        $this->app->singleton(TraxReadModelRepository::class, function ($app) {
            return new TraxReadModelDbRepository(DB::connection());
        });

        $this->app->singleton(TraxService::class, function ($app) {
            return new TraxService(
                resolve(TraxRepository::class)
            );
        });

        $this->app->singleton(TraxRepository::class, function ($app) {
            return new TraxDbRepository(DB::connection());
        });
    }

    public function boot(): void
    {
        //
    }

}
