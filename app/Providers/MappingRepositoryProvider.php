<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Test\TestRepository;
use App\Repositories\Test\TestRepositoryInterface;

class MappingRepositoryProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(TestRepositoryInterface::class, TestRepository::class);
    }
}