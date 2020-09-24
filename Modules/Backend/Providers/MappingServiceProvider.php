<?php

namespace Modules\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Backend\Services\ACL\ACLService;
use Modules\Backend\Services\ACL\ACLServiceInterface;
use Modules\Backend\Services\CoreConfig\CoreConfigService;
use Modules\Backend\Services\CoreConfig\CoreConfigServiceInterface;
use Modules\Backend\Services\Product\ProductService;
use Modules\Backend\Services\Product\ProductServiceInterface;
use Modules\Backend\Services\ShopOwner\ShopOwnerService;
use Modules\Backend\Services\ShopOwner\ShopOwnerServiceInterface;

class MappingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(ShopOwnerServiceInterface::class, ShopOwnerService::class);
        $this->app->singleton(CoreConfigServiceInterface::class, CoreConfigService::class);
        $this->app->singleton(ACLServiceInterface::class, ACLService::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
    }
}
