<?php

namespace Modules\Backend\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelEventServiceProvider;
use Modules\Backend\Listeners\ShopOwner\ShopOwnerListener;

class EventServiceProvider extends LaravelEventServiceProvider
{
    protected $subscribe = [
        ShopOwnerListener::class,
    ];
}
