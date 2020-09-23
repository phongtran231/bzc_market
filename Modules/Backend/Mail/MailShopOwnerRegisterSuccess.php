<?php

namespace Modules\Backend\Mail;

use Illuminate\Mail\Mailable;

class MailShopOwnerRegisterSuccess extends Mailable
{
    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function build()
    {
        $this->to($this->_data['model']->email)->view('backend::mail.shop-owner-register-success', $this->_getMailData());
    }

    /**
     * @return array
     */
    protected function _getMailData(): array
    {
        return [
            'password' => $this->_data['password'],
            'model' => $this->_data['model'],
        ];
    }
}
