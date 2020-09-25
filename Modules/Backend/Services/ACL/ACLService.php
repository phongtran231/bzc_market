<?php

namespace Modules\Backend\Services\ACL;

use App\Models\Admin;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Modules\Backend\Http\Requests\SetRoleForAdminRequest;
use Modules\Backend\Services\BaseService;

class ACLService extends BaseService implements ACLServiceInterface
{
    /**
     * @var RoleRepositoryInterface
     */
    protected $_roleRepository;

    /**
     * @var PermissionRepositoryInterface
     */
    protected $_permissionRepository;

    /**
     * @var AdminRepositoryInterface
     */
    protected $_adminRepository;

    /**
     * ACLService constructor.
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     * @param AdminRepositoryInterface $adminRepository
     */
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository,
        AdminRepositoryInterface $adminRepository
    )
    {
        $this->_roleRepository = $roleRepository;
        $this->_permissionRepository = $permissionRepository;
        $this->_adminRepository = $adminRepository;
    }

    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
        // TODO: Implement index() method.
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function createRole(array $attributes): array
    {
        if (!isset($attributes['guard_name'])) {
            $attributes['guard_name'] = Admin::GUARD_NAME;
        }
        try {
            if ($this->_roleRepository->count(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])) {
                return $this->_setResponseError('Role đã tồn tại')->_getResponseError();
            }
            $data = $this->_roleRepository->create($attributes);
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function createPermission(array $attributes): array
    {
        if (!isset($attributes['guard_name'])) {
            $attributes['guard_name'] = Admin::GUARD_NAME;
        }
        try {
            if ($this->_permissionRepository->count(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])) {
                return $this->_setResponseError("Permission đã tồn tại")->_getResponseError();
            }
            $data = $this->_permissionRepository->create($attributes);
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function setRoleForAdmin(array $attributes): array
    {
        $admin = $this->_adminRepository->firstWhere(['user_name' => $attributes['admin_name']]);
        $admin->assignRole($attributes['role_name']);
        return $this->_setResponseSuccess('Thêm role thành công')->_getResponseSuccess();
    }
}
