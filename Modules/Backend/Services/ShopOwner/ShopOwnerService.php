<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Models\ShopOwner;
use App\Repositories\ShopOwner\ShopOwnerRepositoryInterface;
use Modules\Backend\Events\ShopOwner\CreatedShopOwnerEvent;
use Modules\Backend\Services\BaseService;

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

    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
        if ($paginate) {
            $response = $this->_shopOwnerRepository->simplePaginate($perPage, $select);
        } else {
            $response = $this->_shopOwnerRepository->all($select);
        }
        return $this->_setResponseSuccess($response)->_getResponseSuccess();
    }

    /**
     * @return \App\Models\ShopOwner|array
     */
    public function getInfo()
    {
        return $this->_setResponseSuccess($this->_auth->user())->_getResponseSuccess();
    }

    /**
     * @param array $attributes
     * @return array|mixed
     */
    public function store(array $attributes)
    {
        try {
            $response = $this->_shopOwnerRepository->create($attributes);
            event(new CreatedShopOwnerEvent($response));
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getMessage())->_getResponseError();
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        return $this->_setResponseSuccess($this->_shopOwnerRepository->find($id))->_getResponseSuccess();
    }

    /**
     * @param array $attributes
     * @param ShopOwner $shopOwner
     * @return array
     */
    public function resetPassword(array $attributes, $shopOwner)
    {
        $userMail = $attributes['user_mail'];
        $userMail = decrypt($userMail);

        if ($userMail != $shopOwner->email) {
            return $this->_setResponseError("Mã bảo mật không đúng")->_getResponseError();
        }

        $password = bcrypt($attributes['new_password']);
        $shopOwner->password = $password;
        $shopOwner->save();
        return $this->_setResponseSuccess($shopOwner)->_getResponseSuccess();
    }
}
