<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Repositories\ShopOwner\ShopOwnerRepositoryInterface;
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
    protected $_shopOwnerRepository;

    protected $_auth;

    public function __construct(
        ShopOwnerRepositoryInterface $shopOwnerRepository
    )
    {
        $this->_shopOwnerRepository = $shopOwnerRepository;
        $this->_auth = auth('shop_owner');
    }

    /**
     * @inheritDoc
     */
    public function getInfo()
    {
        return $this->_auth->user();
    }

    public function store(array $attributes)
    {
        try {
            return $this->_shopOwnerRepository->create($attributes);
        } catch (\Exception $e) {
            return false;
        }
    }
}
