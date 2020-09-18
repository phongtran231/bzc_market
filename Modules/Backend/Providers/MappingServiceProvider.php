<?php

namespace Modules\Backend\Providers;

use App\Providers\AppServiceProvider;
use Modules\Backend\Services\Test\TestService;
use Modules\Backend\Services\Test\TestServiceInterface;

class MappingServiceProvider extends AppServiceProvider
{
    public function boot()
    {
        $this->app->singleton(TestServiceInterface::class, TestService::class);
    }
}