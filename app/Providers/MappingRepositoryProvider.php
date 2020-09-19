<?php

namespace App\Providers;

use App\Repositories\Test\TestRepository;
use App\Repositories\Test\TestRepositoryInterface;

class MappingRepositoryProvider extends AppServiceProvider
{
    public function boot()
    {
        $this->app->singleton(TestRepositoryInterface::class, TestRepository::class);
    }
}