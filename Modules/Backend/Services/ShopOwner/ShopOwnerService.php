<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Repositories\ShopOwner\ShopOwnerRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Modules\Backend\Services\BaseService;

/**
 * Class ShopOwnerService
 * @package Modules\Backend\Services\ShopOwner
 * @author S5K (s5k.github.io)
 */
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

    /**
     * @inheritDoc
     */
    public function getInfo()
    {
        return $this->shopOwnerRepository->find(auth()->guard('api')->id());
    }

    /**
     * @inheritDoc
     */
    public function update(Request $attrs)
    {

    }

    /**
     * @inheritDoc
     */
    public function save(Request $attrs)
    {
        // TODO: Implement save() method.
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }
}
