<?php
namespace Theme\Main\Http\Controllers;

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
use EmailHandler;

class CartController extends PublicController
{
    //Get Cart:
    public function getCart()
    {
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
            foreach ($detailCart as $detail) {
                $detailCartProduct = CartDetail::deleteCartDetail($detail->id);
            }
            $notification = array(
                'message' => 'Xác nhận đơn hàng thành công!',
                'alert-type' => 'success'
            );
            EmailHandler::send(view('theme.main::views.pages.mail.confirm-order'), 'Re: ' . 'Xác nhận đơn hàng', $input['email']);
            return redirect()->route('product.index')->with($notification);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
        }
    }
}
