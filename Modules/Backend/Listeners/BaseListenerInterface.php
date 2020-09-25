<?php

namespace Modules\Backend\Listeners;

use Illuminate\Events\Dispatcher;

interface BaseListenerInterface
{
    public function subscribe(Dispatcher $event);
}
