<?php
namespace Theme\Main\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Platform\Ecommerce\Models\Customer;
use Platform\Theme\Http\Controllers\PublicController;
use Theme;
use Theme\Main\Http\Requests\RegisterRequest;

class LoginController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getViewLogin()
    {
        return Theme::scope('auth.login')->render();
    }

    /**
     * {@inheritDoc}
     */
    public function getViewRegister()
    {
        return Theme::scope('auth.register')->render();
    }

    /**
     * {@inheritDoc}
     */
    public function register(RegisterRequest $request)
    {
        try {
            $input = $request->all();
            $saveCustomer = Customer::saveCustomer($input);
            if (!$saveCustomer) {
                return \Redirect::back()->withErrors(['error' => 'Đăng ký thông tin thất bại!']);
            }
            return \Redirect::back()->with(['success' => 'Đăng ký thông tin thành công']);
        } catch(Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

    public function login(Request $request)
    {
        dd(0);
    }
}
