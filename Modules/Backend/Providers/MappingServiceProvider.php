<?php

namespace Modules\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Backend\Services\ShopOwner\ShopOwnerService;
use Modules\Backend\Services\ShopOwner\ShopOwnerServiceInterface;

class MappingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(ShopOwnerServiceInterface::class, ShopOwnerService::class);
    }
}
