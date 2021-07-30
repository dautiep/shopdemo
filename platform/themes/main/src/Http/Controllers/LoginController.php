<?php
namespace Theme\Main\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Platform\Cart\Models\Cart;
use Platform\Ecommerce\Models\Customer;
use Platform\Theme\Http\Controllers\PublicController;
use Theme\Main\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use EmailHandler;
use Illuminate\Support\Str;
use Theme;
use SeoHelper;
use MetaBox;
use RvMedia;

class LoginController extends PublicController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * {@inheritDoc}
     */
    public function getViewLogin()
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Đăng nhập'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        return Theme::scope('auth.login')->render();
    }

    /**
     * {@inheritDoc}
     */
    public function getViewRegister()
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Đăng ký'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        return Theme::scope('auth.register')->render();
    }

    public function forgetPassword()
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Quên mật khẩu'), theme_option('seo_title', ''), '|')
            ->setDescription(theme_option('seo_description'))
            ->openGraph()
            ->setTitle(@theme_option('seo_title'))
            ->setSiteName(@theme_option('site_title'))
            ->setImage(RvMedia::getImageUrl(theme_option('seo_og_image'), 'og', false, RvMedia::getImageUrl(theme_option('seo_og_image'))))
            ->addProperties(
                [
                    'image:width' => '1200',
                    'image:height' => '630'
                ]);
        //end SEO

        return Theme::scope('auth.forget-password')->render();
    }

    public function postForgetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ],

        [
            'required' => ':attribute không được bỏ trống!',
            'email' => ':attribute không hợp lệ!'
        ],

        [
            'email' => 'Địa chỉ email',
        ]);

        $input = $request->all();
        $user = Customer::checkEmailExist($input['email']);
        if (empty($user)) {
            $notification = array(
                'message' => 'Địa chỉ email không tồn tại trong hệ thống',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        EmailHandler::send(view('theme.main::views.pages.mail.confirm-change-password', ['user' => $user]), 'Re: ' . 'Thay đổi mật khẩu', $input['email']);
        $notification = array(
            'message' => 'Chúng tôi đã gửi cho bạn email để đổi mật khẩu! Vui lòng kiểm tra thư của mình',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function resetPassword($userId)
    {   $user = Customer::getCustomerById($userId);
        return Theme::scope('auth.reset-password', ['user' => $user])->render();
    }

    public function postResetPassword(Request $request, $customerId)
    {
        $this->validate($request, [
            'passwordCustomer' =>'required|min:8',
            'passwordCustomerConfirm' =>'required|same:passwordCustomer',
        ],

        [
            'required' => ':attribute không được bỏ trống!',
            'same' => ':attribute không hợp lệ!'
        ],

        [
            'passwordCustomer' => 'Mật khẩu mới',
            'passwordCustomerConfirm' => 'Xác thực mật khẩu',
        ]);

        $input = $request->all();

        $updateCustomer = Customer::updatePassword($input, $customerId);

        if (!$updateCustomer) {
            $notification = array(
                'message' => 'Thay đổi mật khẩu thất bại! Vui lòng thử lại',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'Thay đổi mật khẩu thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('guest.login')->with($notification);
    }

    /**
     * {@inheritDoc}
     */
    public function register(RegisterRequest $request)
    {
        try {
            $input = $request->all();
            //create customer
            $saveCustomer = Customer::saveCustomer($input);

            //create cart customer
            $dataCart = [];
            $dataCart['customerId'] = $saveCustomer->id;
            $saveCart = Cart::saveCart($dataCart);
            if (!$saveCustomer || !$saveCart) {
                return \Redirect::back()->withErrors(['error' => 'Đăng ký thông tin thất bại!']);
            }
            return \Redirect::back()->with(['success' => 'Đăng ký thông tin thành công']);
        } catch(Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }
}
