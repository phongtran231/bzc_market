<?php

namespace Modules\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Backend\Services\Test\TestService;
use Modules\Backend\Services\Test\TestServiceInterface;


class MappingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(TestServiceInterface::class, TestService::class);
    }
}