<?php

namespace Modules\Backend\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Backend\Http\Controllers\Api\ApiAbstractController;
use Modules\Backend\Mail\MailAdminResetPassword;
use Modules\Backend\Requests\AdminLoginRequest;
use Modules\Backend\Requests\AdminResetPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiAbstractController
{

    const ADMIN_GUARD = 'admin';

    /**
     * @var \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $_auth;

    /**
     * @var Admin
     */
    protected $_admin;

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
        return $this->responseError("Không tìm thấy thông tin đăng nhập", Response::HTTP_UNAUTHORIZED);
    }

    protected function returnWithToken($token)
    {
        return $this->responseSuccess([
            'token' => $token,
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProfile()
    {
        if ($this->_auth->check()) {
            return $this->responseSuccess($this->_auth->user());
        }
        return $this->responseError("Không tìm thấy thông tin đăng nhập", Response::HTTP_UNAUTHORIZED);
    }

    public function forgetPassword(AdminResetPasswordRequest $request)
    {
        try {
            $secretKey = config('admin_config.secret_key_reset_password');
            if ($request->input('secret_key') != $secretKey) {
                return $this->responseError("Sai mã bảo mật");
            }

            $password = Str::random(30);
            $admin = $this->_admin->where('user_name', $request->input('user_name'))->first();
            $admin->password = bcrypt($password);
            $admin->save();
            Mail::send(new MailAdminResetPassword($password));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
