<?php

namespace Modules\Backend\Listeners\ShopOwner;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Backend\Events\ShopOwner\CreatedShopOwnerEvent;
use Modules\Backend\Listeners\BaseListenerInterface;
use Modules\Backend\Mail\MailShopOwnerRegisterSuccess;

class ShopOwnerListener implements BaseListenerInterface
{

    /**
     * thêm password cho shop owner
     * @param CreatedShopOwnerEvent $event
     */
    public function created(CreatedShopOwnerEvent $event)
    {
        $shopOwner = $event->model;
        $password = Str::random(30);
        $shopOwner->password = bcrypt($password);
        $shopOwner->save();

        Mail::send(new MailShopOwnerRegisterSuccess([
            'password' => $password,
            'model' => $shopOwner,
        ]));
    }

    public function subscribe(Dispatcher $event)
    {
        $event->listen(
            CreatedShopOwnerEvent::class,
            static::class.'@created');
    }
}
