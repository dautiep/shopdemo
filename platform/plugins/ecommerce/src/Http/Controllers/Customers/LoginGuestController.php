<?php

namespace Platform\Ecommerce\Http\Controllers\Customers;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Platform\ACL\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Theme;
use SeoHelper;
use RvMedia;

class LoginGuestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.guest', ['except' => 'logout']);
    }

    public function index() {
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
     * @param Request $request
     * @return Response|void
     * @throws ValidationException
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }
        $request->offsetSet('password', '$2y$10$SzHONPyOyJmUy4DBc9CM/.AGGE9gLtlpXb2Y0RmyoibISgwvJfnzi');

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/admin/auth/login');
    }

}
