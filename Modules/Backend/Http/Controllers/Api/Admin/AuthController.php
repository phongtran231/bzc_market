<?php

namespace Modules\Backend\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Backend\Http\Controllers\Api\ApiAbstractController;
use Modules\Backend\Http\Requests\AdminResetPasswordRequest;
use Modules\Backend\Mail\MailAdminResetPassword;
use Modules\Backend\Http\Requests\AdminLoginRequest;
use Modules\Backend\Http\Requests\AdminForgetPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiAbstractController
{

    const ADMIN_GUARD = 'admin';

    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $_auth;

    /**
     * @var Admin
     */
    protected $_admin;

    /**
     * AuthController constructor.
     * @param Admin $admin
     */
    public function __construct(
        Admin $admin
    )
    {
        $this->_auth = auth(self::ADMIN_GUARD);
        $this->_admin = $admin;
    }

    /**
     * @param AdminLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request)
    {
        if ($token = $this->_auth->attempt($request->only(['user_name', 'password']))) {
            return $this->returnWithToken($token);
        }
        return $this->_responseError("Không tìm thấy thông tin đăng nhập", Response::HTTP_UNAUTHORIZED);
    }

    protected function returnWithToken($token)
    {
        return $this->_responseSuccess([
            'token' => $token,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProfile()
    {
        if ($this->_auth->check()) {
            return $this->_responseSuccess($this->_auth->user());
        }
        return $this->_responseError("Không tìm thấy thông tin đăng nhập", Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param AdminForgetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword(AdminForgetPasswordRequest $request)
    {
        try {
            $secretKey = config('admin_config.secret_key_reset_password');
            if ($request->input('secret_key') != $secretKey) {
                return $this->_responseError("Sai mã bảo mật");
            }

            $password = Str::random(30);
            $admin = $this->_admin->where('user_name', $request->input('user_name'))->first();
            $admin->password = bcrypt($password);
            $admin->save();
            Mail::send(new MailAdminResetPassword($password));

            return $this->_responseSuccess("Mật khẩu mới đã được đổi, vui lòng kiểm tra mail để lấy mật khẩu mới");
        } catch (\Exception $e) {
            return $this->_responseError($e->getTraceAsString());
        }
    }

    /**
     * @param AdminResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(AdminResetPasswordRequest $request)
    {
        try {
            $secretKey = config('admin_config.secret_key_reset_password');
            if ($request->input('secret_key') != $secretKey) {
                return $this->_responseError("Sai mã bảo mật");
            }

            $password = $request->input('new_password');
            $admin = $this->_admin->where('user_name', $request->input('user_name'))->first();
            $admin->password = bcrypt($password);
            $admin->save();

            return $this->_responseSuccess("Mật khẩu mới đã được đổi");
        } catch (\Exception $e) {
            return $this->_responseError($e->getTraceAsString());
        }
    }
}
