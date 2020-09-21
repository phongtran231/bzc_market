<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Repositories\ShopOwner\ShopOwnerRepositoryInterface;
use Modules\Backend\Services\BaseService;

class ShopOwnerService extends BaseService implements ShopOwnerServiceInterface
{
    /**
     * @var ShopOwnerRepositoryInterface
     */
    protected $shopOwnerRepository;

    public function __construct(
        ShopOwnerRepositoryInterface $shopOwnerRepository
    )
    {
        $this->shopOwnerRepository = $shopOwnerRepository;
    }
}
