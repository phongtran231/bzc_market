<?php

namespace Modules\Backend\Mail;

use Illuminate\Mail\Mailable;

class MailAdminResetPassword extends Mailable
{
    /**
     * @var string
     */
    protected $_password;

    public function __construct(string $password)
    {
        $this->_password = $password;
    }

    public function build()
    {
        try {
            $this->to(config('admin_config.admin_mail'))->view('backend::mail.admin-reset-password', ['password' => $this->_password]);
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
        }
    }
}
