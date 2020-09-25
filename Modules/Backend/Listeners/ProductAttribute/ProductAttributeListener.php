<?php

namespace Modules\Backend\Listeners\ProductAttribute;

use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use Illuminate\Events\Dispatcher;
use Modules\Backend\Events\ProductAttribute\CreatedProductAttributeEvent;
use Modules\Backend\Events\ProductAttribute\UpdatedProductAttributeEvent;
use Modules\Backend\Listeners\BaseListenerInterface;

class ProductAttributeListener implements BaseListenerInterface
{
    /**
     * @var ProductAttributeRepositoryInterface
     */
    protected $_productAttributeRepository;

    /**
     * ProductAttributeListener constructor.
     * @param ProductAttributeRepositoryInterface $productAttributeRepository
     */
    public function __construct(
        ProductAttributeRepositoryInterface $productAttributeRepository
    )
    {
        $this->_productAttributeRepository = $productAttributeRepository;
    }

    public function created(CreatedProductAttributeEvent $event)
    {
        $model = $event->model;
        $this->_productAttributeRepository->sync($model->id, 'productAttributeGroups', $event->groupId);
    }

    public function updated(UpdatedProductAttributeEvent $event)
    {
        $this->_productAttributeRepository->sync($event->model->id, 'productAttributeGroups', $event->groupId);
    }

    public function subscribe(Dispatcher $event)
    {
        $event->listen(
            CreatedProductAttributeEvent::class,
            static::class . '@created'
        );
        $event->listen(
            UpdatedProductAttributeEvent::class,
            static::class . '@updated'
        );
    }
}
