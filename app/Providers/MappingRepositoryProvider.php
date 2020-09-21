<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Repositories\ProductAttributeValue\ProductAttributeValueRepository;
use App\Repositories\ProductAttributeValue\ProductAttributeValueRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\ShopOwner\ShopOwnerRepository;
use App\Repositories\ShopOwner\ShopOwnerRepositoryInterface;
use App\Repositories\SlugMapping\SlugMappingMappingRepository;
use App\Repositories\SlugMapping\SlugMappingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class MappingRepositoryProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(ProductCategoryRepositoryInterface::class, ProductCategoryRepository::class);
        $this->app->singleton(ProductAttributeRepositoryInterface::class, ProductAttributeRepository::class);
        $this->app->singleton(ProductAttributeValueRepositoryInterface::class, ProductAttributeValueRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(SlugMappingRepositoryInterface::class, SlugMappingMappingRepository::class);
        $this->app->singleton(ShopOwnerRepositoryInterface::class, ShopOwnerRepository::class);
    }
}
