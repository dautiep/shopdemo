<?php
namespace Theme\Main\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Platform\Cart\Models\Cart;
use Platform\Cart\Models\Province;
use Platform\CartDetail\Models\CartDetail;
use Platform\Ecommerce\Models\Order;
use Platform\Ecommerce\Models\OrderAddress;
use Platform\Ecommerce\Models\OrderProduct;
use Platform\Ecommerce\Models\Product;
use Platform\Theme\Http\Controllers\PublicController;
use Theme\Main\Http\Requests\OrderRequest;
use Theme;
use SeoHelper;
use MetaBox;
use RvMedia;
use EmailHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Platform\Ecommerce\Models\Customer;
use Platform\Payment\Services\Gateways\PayPalPaymentService;

class CartController extends PublicController
{
    /**
     * @var PayPalPaymentService
     */
    protected $payPalService;

    /**
     * PaymentController constructor.
     * @param PayPalPaymentService $payPalService
     */

    public function __construct(PayPalPaymentService $payPalService)
    {
        $this->payPalService = $payPalService;
    }

    //Get Cart:
    public function getCart()
    {
        //start SEO
        SeoHelper::setTitle(Str::upper('Giỏ hàng'), theme_option('seo_title', ''), '|')
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

        $cartId = auth('customer')->user()->getCart->id;
        $data['detailCart'] = CartDetail::getDetailCartByCardId($cartId);
        $data['allQuantity'] = 0;
        $data['allPrice'] = [];
        $data['totalMoney'] = 0;
        foreach ($data['detailCart'] as $k => $detail) {
            $data['allQuantity'] = $data['allQuantity'] + $detail->quantity;
            $data['allPrice'][$k] = 0;
            if (!empty($detail->getProduct->sale_price)) {
                $data['allPrice'][$k] = $data['allPrice'][$k] + $detail->quantity * $detail->getProduct->sale_price;
                $data['totalMoney'] = $data['totalMoney'] + $data['allPrice'][$k];
            } else {
                $data['allPrice'][$k] = $data['allPrice'][$k] + $detail->quantity * $detail->getProduct->price;
                $data['totalMoney'] = $data['totalMoney'] + $data['allPrice'][$k];
            }
        }
        return Theme::scope('pages.cart', $data)->render();
    }

    public function addCart(Request $request, $guard = 'customer')
    {
        try {
            if (!Auth::guard($guard)->check()) {
                $notification = array(
                    'message' => 'Vui lòng đăng nhập để tiến hành mua hàng',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            } else {
                $input = $request->all();
                $dataDetailCart = [];
                $dataDetailCart['cartId'] = auth('customer')->user()->getCart->id;
                $dataDetailCart['productId'] = $input['productId'];
                $dataDetailCart['quantityProduct'] = $input['quantityProduct'];

                $checkDetailCart = CartDetail::getDetailcart($dataDetailCart['cartId'], $dataDetailCart['productId']);
                if (empty($checkDetailCart)) {
                    $saveDetailCart = CartDetail::saveDetailCart($dataDetailCart);
                } else {
                    $saveDetailCart = CartDetail::updateDetailCart($dataDetailCart);
                }
                if (!$saveDetailCart) {
                    $notification = array(
                        'message' => 'Thêm vào giỏ hàng thất bại! Vui lòng thử lại',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
                $notification = array(
                    'message' => 'Thêm vào giỏ hàng thành công',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $input = $request->all();
            $updateCartDetail = CartDetail::updateQuantity($input);
             if (!$updateCartDetail) {
                return \Response::json(['error' => 'fail', 'message' => 'Cập nhật giỏ hàng thất bại!']);
            }
            return \Response::json(['success' => 'success', 'message' => 'Cập nhật giỏ hàng thành công!']);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

    public function removeDetailCart(Request $request)
    {
        try {
            $input = $request->all();
            $cartDetail = CartDetail::getDetailCartById($input);
            if (!empty($cartDetail)) {
                $cartDetail->delete();
            }
            return \Response::json(['success' => 'success', 'message' => 'Xóa sản phẩm thành công!']);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }
    public function payment(){
        //start SEO
        SeoHelper::setTitle(Str::upper('Thanh toán'), theme_option('seo_title', ''), '|')
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

        $cartId = auth('customer')->user()->getCart->id;
        $data['provinces'] = Province::getAll();
        $data['customer'] = auth('customer')->user();
        $data['detailCart'] = CartDetail::getDetailCartByCardId($cartId);
        $data['allQuantity'] = 0;
        $data['allPrice'] = [];
        $data['totalMoney'] = 0;
        foreach ($data['detailCart'] as $k => $detail) {
            $data['allQuantity'] = $data['allQuantity'] + $detail->quantity;
            $data['allPrice'][$k] = 0;
            if (!empty($detail->getProduct->sale_price)) {
                $data['allPrice'][$k] = $data['allPrice'][$k] + $detail->quantity * $detail->getProduct->sale_price;
                $data['totalMoney'] = $data['totalMoney'] + $data['allPrice'][$k];
            } else {
                $data['allPrice'][$k] = $data['allPrice'][$k] + $detail->quantity * $detail->getProduct->price;
                $data['totalMoney'] = $data['totalMoney'] + $data['allPrice'][$k];
            }
        }
        return Theme::scope('pages.checkout1', $data)->render();
    }

    public function createOrder(OrderRequest $request)
    {
        try {
            $input= $request->all();
            $input['type_payment'] = 0;
            $input['is_purchased'] = 'Chưa Thanh Toán';
            $saveOrder = Order::saveOrder($input);
            $cartId = auth('customer')->user()->getCart->id;
            $detailCart = CartDetail::getDetailCartByCardId($cartId);
            foreach ($detailCart as $detail) {
                $dataOrderProduct[] = [
                    'order_id' => $saveOrder->id,
                    'qty' => $detail->quantity,
                    'price' => (!empty($detail->getProduct->sale_price)) ? $detail->getProduct->sale_price : $detail->getProduct->price,
                    'product_id' => $detail->getProduct->id,
                    'product_name' => $detail->getProduct->name
                ];
                $updateQuantityPproduct = Product::updateQuantity($detail->quantity, $detail->getProduct->id);
            }
            $saveOrderProduct = OrderProduct::saveOrderProduct($dataOrderProduct);
            $data['orderAddress'] = [
                'orderId' => $saveOrder->id,
                'addressOrder' => $input['address'],
                'cityOrder' => $input['city']
            ];
            $saveOrderAddress = OrderAddress::saveOrderAddress($data['orderAddress']);
            if (!$saveOrder || !$saveOrderProduct || !$saveOrderAddress) {
                $notification = array(
                    'message' => 'Xác nhận đơn hàng thất bại!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            // foreach ($detailCart as $detail) {
            //     $detailCartProduct = CartDetail::deleteCartDetail($detail->id);
            // }
            $notification = array(
                'message' => 'Xác nhận thông tin đơn hàng thành công!',
                'alert-type' => 'success'
            );
            // EmailHandler::send(view('theme.main::views.pages.mail.confirm-order'), 'Re: ' . 'Xác nhận đơn hàng', $input['email']);
            return redirect()->route('cart.select.payment', $saveOrder->id)->with($notification);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

    public function getViewSelectPayment($orderId)
    {
        $order = Order::getOrderById($orderId);
        $orderAddress = OrderAddress::getOrderAddress($order->id);
        $data = [
            'nameCustomer' => $orderAddress->name,
            'emailCustomer' => $orderAddress->email,
            'phoneCustomer' => $orderAddress->phone,
            'address' => $orderAddress->address . ', ' . $orderAddress->getProvince->ten_tinh,
            'amount' => $order->sub_total,
            'order' => $order->id
        ];
        return Theme::scope('payment.confirm-payment', $data)->render();
    }

    public function paymentShip()
    {
        try {
            DB::beginTransaction();
            $cartId = auth('customer')->user()->getCart->id;
            $detailCart = CartDetail::getDetailCartByCardId($cartId);
            foreach ($detailCart as $detail) {
                $updateQuantityPproduct = Product::updateQuantity($detail->quantity, $detail->getProduct->id);
                $detailCartProduct = CartDetail::deleteCartDetail($detail->id);
                if (!$updateQuantityPproduct  || !$detailCartProduct) {
                    $notification = array(
                        'message' => 'Thanh toán thất bại!',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            }
            DB::commit();
            EmailHandler::send(view('theme.main::views.pages.mail.confirm-order'), 'Re: ' . 'Xác nhận đơn hàng', auth('customer')->user()->email);
            $notification = array(
                'message' => 'Mua hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất',
                'alert-type' => 'success'
            );
            return redirect()->route('public.index')->with($notification);
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

    public function checkout(Request $request)
    {
        $currency = $request->input('currency', config('plugins.payment.payment.currency'));
        $currency = strtoupper($currency);
        $checkoutUrl = $this->payPalService->execute($request);
        if ($checkoutUrl) {
            return redirect($checkoutUrl);
        }
        $data['error'] = true;
        $data['message'] = $this->payPalService->getErrorMessage();
        if ($data['error']) {
            return redirect()->back()->with('error_msg', $data['message'])->withInput($request->input());
        }

        return redirect()->back()->with('success_msg', trans('plugins/payment::payment.checkout_success'));

    }

    public function GetPayonline($orderId)
    {
        $data['order'] = Order::getOrderById($orderId);
        return Theme::scope('payment.index', $data)->render();
    }

    public function payOnline(Request $request)
    {
        $vnp_TxnRef = $_POST['orderId']; //Reference code of transaction at Merchant system. This code is unique and used to differentiate orders sent to VNPAY. Codes must not be duplicated within a day.
        $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderType = $_POST['order_type'];
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.0.1",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('VNPay.return') ,
            "vnp_TxnRef" => $vnp_TxnRef

        );
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html' . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function VNPayreturn(Request $request)
    {
        try {
            DB::beginTransaction();
            $response = $request->toArray();
            $vnp_HashSecret = env('VNP_HASH_SECRET');
            $vnp_SecureHash = $response['vnp_SecureHash'];
            $inputData = [];
            foreach ($response as $key => $value) {
                if ($key == 'vnp_SecureHashType' || $key == 'vnp_SecureHash') {
                    continue;
                }
                if (substr($key, 0, 4) == 'vnp_') {
                    $inputData[$key] = $value;
                }
            }

            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . $key . "=" . $value;
                } else {
                    $hashData = $hashData . $key . "=" . $value;
                    $i = 1;
                }
            }
            $secureHash = hash('sha256',$vnp_HashSecret . $hashData);

            if ($secureHash == $vnp_SecureHash) {
                if (!empty($response['vnp_ResponseCode']) && $response['vnp_ResponseCode'] == '00') {
                    $inputData['paymentResult'] = 1;
                    if (!empty($response['vnp_TxnRef'])) {
                        $order = Order::getOrderById($response['vnp_TxnRef']);
                        if (!empty($order)) {
                            $order->status = 'processing';
                            $order->is_purchased = 'Đã thanh toán';
                            $order->type_payment = 1;
                            $order->purchased_at = Carbon::now()->addHours(7);
                            $inputData['purchased'] = Carbon::now()->addHours(7);
                            $order->save();

                            $cartId = auth('customer')->user()->getCart->id;
                            $detailCart = CartDetail::getDetailCartByCardId($cartId);
                            foreach ($detailCart as $detail) {
                                CartDetail::deleteCartDetail($detail->id);
                            }
                            DB::commit();
                            return Theme::scope('payment.vnpay_return', $inputData)->render();
                        }
                    } else {
                        return Theme::scope('payment.vnpay_return', $inputData)->render();
                    }
                } else {
                    return Theme::scope('payment.vnpay_return', $inputData)->render();
                }
            } else {
                return Theme::scope('payment.vnpay_return', $inputData)->render();
            }

        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }

}
