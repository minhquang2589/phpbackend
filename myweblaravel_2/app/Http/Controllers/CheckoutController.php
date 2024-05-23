<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderEmail;

use App\Models\Orders;
use App\Models\Payment;
use App\Models\Customers;
use Illuminate\Support\Facades\Redirect;
use App\Models\color;
use App\Models\Product;
use App\Models\ordernumber;
use App\Models\size;
use App\Models\Discounts;
use App\Models\User;
use App\Models\product_colors;
use App\Models\product_sizes;
use Illuminate\Support\Str;
use App\Models\product_variants;
use App\Models\ProductVariant;
use App\Models\Vouchers;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;



class CheckoutController extends Controller
{
    // protected $emailController;

    // public function __construct(EmailController $emailController)
    // {
    //     $this->emailController = $emailController;
    // }

    //
    public function checkoutView(Request $request)
    {
        $cart = Session::get('cart');
        $orderNumber = Session::get('orderNumber');
        $dataCart = Session::get('dataCart');
        $aruvoucher = Session::get('aruvoucher');
        if (!$cart) {
            return response()->json([
                'success' => false,
                'cart' => false,
            ]);
        }
        if ($cart) {
            $cartQuantity = count($cart);
        } else {
            $cartQuantity = 0;
        }
        $subtotal = 0;
        $totalWithoutVat = 0;
        $total = 0;
        $vatRate = 0;
        $vat = 0;
        $totalDiscountAmount = 0;
        $totalOriginalPrice = 0;

        if ($cart) {
            foreach ($cart as $item) {
                if (is_array($item) && isset($item['id'])) {
                    $discount = $item['discountPercent'] ?? 0;
                    $product = Product::find($item['id']);
                    if ($product) {
                        $productPrice = $product->price;
                        $productVariant = ProductVariant::where('product_id', $product->id)
                            ->whereHas('size', function ($query) use ($item) {
                                $query->where('size', $item['size']);
                            })
                            ->whereHas('color', function ($query) use ($item) {
                                $query->where('color', $item['color']);
                            })
                            ->first();
                        if ($productVariant) {
                            if ($productVariant->discount_id) {
                                $discountData = Discounts::where('id', $productVariant->discount_id)
                                    ->where('start_datetime', '<=', Carbon::now())
                                    ->where('end_datetime', '>=', Carbon::now())
                                    ->first();
                                if ($discountData) {
                                    $discount = $discountData->discount;
                                }
                            }
                            $discountAmount = ($productPrice * $discount) / 100;
                            $subtotal += ($productPrice - $discountAmount) * $item['quantity'];
                            $totalWithoutVat += $productPrice * $item['quantity'];
                            $totalDiscountAmount += $discountAmount * $item['quantity'];
                            $totalOriginalPrice += $productPrice * $item['quantity'];
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => ['error!'],
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => ['error!'],
                        ]);
                    }
                }
            }
        }
        $voucherCode = $request->input('voucher');
        if ($voucherCode) {
            $voucher = Vouchers::where('voucher_code', $voucherCode)
                ->where('voucher_quantity', '>', 0)
                ->where('status', '=', 'Active', '||', 'Used')
                ->where('discount_value', '>', 0)
                ->first();
            if ($voucher) {
                $VoucherValue = $voucher->discount_value;
                $voucherDiscountPercentage = ($VoucherValue / 100) * $subtotal;
                $subtotal -= $voucherDiscountPercentage;
                $totalDiscountAmount += $voucherDiscountPercentage;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Voucher is invalid or expired!'],
                ]);
            }
        }

        $vat = $subtotal * $vatRate;
        $total = $totalWithoutVat + $vat;
        $DETACheckout = [
            'voucherCode' => $voucherCode ?? null,
            'checkoutTotal' => $total,
            'checkoutTotal' => $total,
            'checkoutSubtotal' => $subtotal,
            'VoucherValue' => $VoucherValue ?? null,
            'totalDiscountAmount' => $totalDiscountAmount ?? null,
            'cartCheckout' => $cart,
            'cartQuantity' => $cartQuantity,
        ];
        Session::put('DETACheckout', $DETACheckout);
        return response()->json([
            'success' => true,
            'DETACheckout' => $DETACheckout,
        ]);
    }

    /////
    public function process(Request $request)
    {
        $DETACheckout = Session::get('DETACheckout');
        $cart = Session::get('cart');
        if (!$DETACheckout || !$cart) {
            return response()->json([
                'success' => false,
                'cart' => false,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\d{10}$/',
            'address' => 'required|string|max:255',
            'note' => 'max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $payment = $request->input('payment');
        switch ($payment) {
            case 'qr':
                $payment = 'Thanh toán bằng mã QR code';
                break;
            case 'meet':
                $payment = 'Thanh toán khi nhận hàng';
                break;
            case 'paypal':
                $payment = 'Thanh toán bằng Paypal';
                break;
            case 'bank':
                $payment = 'Chuyển khoản';
                break;
            default:
                break;
        }
        $element = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'notes' => $request->input('note'),
            'phone' => $request->input('phone'),
            'payment' =>  $payment,
            'subtotal' => $DETACheckout['checkoutSubtotal'],
            'total' => $DETACheckout['checkoutTotal'],
        ];
        $paymentName = $request->input('payment');
        if (!$paymentName) {
            return response()->json([
                'success' => false,
                'message' => ['Please select payment method'],
            ]);
        }
        $dataCheckout = [
            'element' => $element,
            'cart' => $cart,
            'paymentName' => $paymentName,
            'totalDiscountAmount' => $DETACheckout['totalDiscountAmount'],
            'subtotal' => $DETACheckout['checkoutSubtotal'],
            'total' => $DETACheckout['checkoutTotal'],
        ];
        Session::put('element', $element);
        return response()->json([
            'success' => true,
            'data' => $dataCheckout,
        ]);
    }
    //
    public function paymentView()
    {
        function generateOrderNumber()
        {
            if (!Session::has('orderNumber')) {
                $unique = false;
                $randomDigits = '';
                while (!$unique) {
                    $randomDigits = sprintf('%07d', mt_rand(0, 9999999));
                    $exists = ordernumber::where('order_number', $randomDigits)->exists();
                    if (!$exists) {
                        $unique = true;
                    }
                }
                Session::put('orderNumber', $randomDigits);
                return $randomDigits;
            } else {
                return Session::get('orderNumber');
            }
        }
        function getTime()
        {
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
            return $currentDateTime->format('d/m/Y H:i:s');
        }

        $time = getTime();
        $orderNumber = generateOrderNumber();
        $cart = Session::get('cart');
        // $data = Session::get('data');
        $element = Session::get('element');
        $DETACheckout = Session::get('DETACheckout');
        $dataCheckout = Session::get('dataCheckout');
        if (
            !$orderNumber
            ||  !$cart
            ||  !$element
            ||  !$DETACheckout
        ) {
            return response()->json([
                'success' => false,
                'payment' => false,
            ]);
        }
        Session::put('time', $time);
        return response()->json([
            'success' => true,
            'data' => $DETACheckout,
            'orderNumber' => $orderNumber,
            'element' => $element,
            'dataCheckout' => $dataCheckout,
            'time' => $time,
        ]);
    }
    ///
    //////
    public function handlecheckout(Request $request)
    {
        try {
            DB::beginTransaction();

            $time = Session::get('time');
            $cart = Session::get('cart');
            $orderNumber = Session::get('orderNumber');
            $element = Session::get('element');
            $DETACheckout = Session::get('DETACheckout');

            if ($cart) {
                $voucherCode = $DETACheckout['voucherCode'];
                if ($voucherCode) {
                    $voucher = Vouchers::where('voucher_code', $voucherCode)->first();
                    if ($voucher) {
                        if (
                            $voucher->discount_value <= 0
                            || $voucher->voucher_quantity <= 0
                            || $voucher->status != 'Active'
                        ) {
                            return response()->json([
                                'success' => false,
                                'error' => ['error 1'],
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'error' => ['Voucher not found'],
                        ]);
                    }
                }

                foreach ($cart as $item) {
                    $productId = $item['id'];
                    $discountId = $item['discountId'];
                    $sizeName = $item['size'];
                    $colorName = $item['color'];
                    $quantity = $item['quantity'];
                    $productVariant = ProductVariant::whereHas('size', function ($query) use ($sizeName) {
                        $query->where('size', $sizeName);
                    })->whereHas('color', function ($query) use ($colorName) {
                        $query->where('color', $colorName);
                    })->where('product_id', $productId)->first();

                    if (!$productVariant || $productVariant->quantity < $quantity) {
                        return response()->json([
                            'success' => false,
                            'error' => ['Out of stock'],
                        ]);
                    }

                    if ($discountId) {
                        $discount = Discounts::find($discountId);
                        if (
                            $discount->remaining < $quantity
                            || $discount->status == 'Used'
                            || $discount->status == 'Expired'
                            || $discount->discount <= 0
                        ) {
                            return response()->json([
                                'success' => false,
                                'error' => ['Invalid discount'],
                            ]);
                        }
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'error' => ['Cart is empty'],
                ]);
            }


            $email = $element['email'];
            $customer = Customers::where('email', $email)->first();
            if ($customer) {
                $customer->increment('total_purchases');
            } else {
                $data = [
                    'name' => $element['name'],
                    'email' => $element['email'],
                    'address' => $element['address'],
                    'phone' => $element['phone'],
                    'total_purchases' => 1,
                ];
                $customer = Customers::create($data);
            }

            $payment = Payment::firstOrCreate(['name' => $element['payment']]);
            $ordernumber = ordernumber::create(['order_number' => $orderNumber]);

            $status = $this->getOrderStatus($element['payment']);

            $order = new Orders();
            $order->customer_id = $customer->id;
            $order->total_amount = $element['subtotal'];
            $order->total_discount = $DETACheckout['totalDiscountAmount'] ?? 0;
            $order->payment_method_id = $payment->id;
            $order->status = $status;
            $order->notes = $element['notes'] ?? null;
            $order->voucher_id = Vouchers::where('voucher_code', $DETACheckout['voucherCode'])->value('id');
            $order->order_number_id = $ordernumber->id;
            $order->order_date = $time;
            $order->save();

            foreach ($cart as &$item) {
                $item['finalPrice'] = isset($item['price']) && isset($item['discountPercent']) ?
                    $item['price'] - ($item['price'] * $item['discountPercent']) / 100 : $item['price'];

                $orderItem = new OrderItems();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->color_id = Color::where('color', $item['color'])->value('id');
                $orderItem->size_id = Size::where('size', $item['size'])->value('id');
                $orderItem->order_number_id = $ordernumber->id;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['finalPrice'];
                $orderItem->save();
            }

            DB::commit();
            $orderDate = $time;
            $emailController = new EmailController();
            $emailController->sendMail($orderDate, $element, $orderNumber, $cart, $DETACheckout);
            // send mail in job 
            // SendOrderEmail::dispatch($time, $element, $orderNumber, $cart, $DETACheckout);
            $this->checkoutSuccess($cart, $DETACheckout);
            $this->clearSessionData();
            return response()->json([
                'success' => true,
                'message' => ['Checkout successfully.'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => ['Checkout failed: ' . $e->getMessage()],
            ]);
        }
    }

    protected function checkoutSuccess($cart, $DETACheckout)
    {
        $voucherCode = $DETACheckout['voucherCode'];
        if ($voucherCode) {
            $voucher = Vouchers::where('voucher_code', $voucherCode)->first();
            if ($voucher) {
                $voucher->voucher_quantity -= 1;
                if ($voucher->voucher_quantity <= 0) {
                    $voucher->status = 'Expired';
                }
                $voucher->save();
            }
        }

        foreach ($cart as $item) {
            $discountId = $item['discountId'];
            $productId = $item['id'];
            $sizeName = $item['size'];
            $colorName = $item['color'];
            $quantity = $item['quantity'];

            $product = Product::find($productId);
            if ($product) {
                $product->sales_count += $quantity;
                $product->save();
            }

            $productVariant = ProductVariant::whereHas('size', function ($query) use ($sizeName) {
                $query->where('size', $sizeName);
            })->whereHas('color', function ($query) use ($colorName) {
                $query->where('color', $colorName);
            })->where('product_id', $productId)->first();

            if ($productVariant) {
                $productVariant->quantity = max(0, $productVariant->quantity - $quantity);
                $productVariant->save();
            }

            if ($discountId) {
                $discount = Discounts::find($discountId);
                if ($discount) {
                    $discount->remaining = max(0, $discount->remaining - $quantity);
                    if ($discount->remaining <= 0) {
                        $discount->status = 'Expired';
                        ProductVariant::where('discount_id', $discountId)->update(['discount_id' => null]);
                    }
                    $discount->save();
                }
            }
        }
    }

    protected function getOrderStatus($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'Thanh toán bằng mã QR code':
            case 'Chuyển khoản':
                return 'Đang chờ xác nhận';
            case 'Thanh toán khi nhận hàng':
                return 'Chưa thanh toán';
            case 'Thanh toán bằng Paypal':
                return 'Thanh toán bằng Paypal';
            default:
                return 'Pedding';
        }
    }

    protected function clearSessionData()
    {
        Session::forget([
            'cart', 'time', 'data', 'subtotal', 'voucherCode', 'aruvoucher',
            'DETACheckout', 'element', 'dataCart', 'total', 'voucherDiscountPercent',
            'cartQuantity', 'orderNumber'
        ]);
    }
}
