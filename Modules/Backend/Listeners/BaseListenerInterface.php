<?php

namespace Modules\Backend\Listeners;

interface BaseListenerInterface
{
    public function subscribe($event);
}
