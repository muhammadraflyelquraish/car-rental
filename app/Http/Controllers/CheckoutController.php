<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\OrderPaymentAction;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\StatusApproval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    function show($orderId)
    {
        $order = Order::with('payment', 'car', 'user')->find($orderId);
        return view('landing.checkout', compact('order'));
    }

    function store(Request $request)
    {
        $activeOrder = Order::with('car', 'user', 'payment')
            ->where('user_id', auth()->user()->id)
            ->whereIn('order_status', [
                OrderStatus::WAITING_FOR_PAYMENT,
                OrderStatus::ON_GOING,
                OrderStatus::WAITING_FOR_PICKUP
            ])
            ->latest()
            ->first();

        if (auth()->user()->customer->status_approval != StatusApproval::getStringValue(StatusApproval::APPROVED)) {
            return redirect()->route('home')->with('failed', 'Anda sedang dalam tahap document review');
        } else if ($activeOrder) {
            return redirect()->route('home')->with('failed', 'Anda sedang melakukan rental');
        }

        $order_number = "RBO" . DateTime::createFromFormat('U.u', microtime(true))->format("ymdHisu");

        $order = DB::transaction(function () use ($request, $order_number) {
            $payment_method = PaymentMethod::find($request->payment_method_id);

            $order = Order::create([
                'order_number' => $order_number,
                'car_id' => $request->car_id,
                'user_id' => $request->user_id,
                'driver_id' => $request->driver_id,
                'pickup_location' => $request->pick_up_location,
                'dropoff_location' => $request->drop_off_location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'pickup_time' => $request->pickup_time,
                'order_status' => OrderStatus::WAITING_FOR_PAYMENT
            ]);

            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_number,
                    'gross_amount' => $request->grand_total,
                ),
                'payment_type' => $payment_method->code
            );

            switch ($payment_method->code) {
                case 'gopay':
                    $params['gopay'] =  array(
                        'enable_callback' => true,
                        'callback_url' => 'https://midtrans.com/'
                    );
                    break;
                case 'shopeepay':
                    $params['shopeepay'] = array(
                        'callback_url' => 'https://midtrans.com/'
                    );
                    break;
                default:
                    break;
            }

            $response = \Midtrans\CoreApi::charge($params);

            $order_payment = OrderPayment::create([
                'order_id' => $order->id,
                'payment_method_id' => $request->payment_method_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'grand_total' => $request->grand_total,
                'payment_ref' => $response->transaction_id,
                'payment_status' => PaymentStatus::ON_PROCESS
            ]);

            foreach ($response->actions as $action) {
                OrderPaymentAction::create([
                    'order_payment_id' => $order_payment->id,
                    'name' => $action->name,
                    'method' => $action->method,
                    'url' => $action->url,
                ]);
            }

            return $order;
        });

        return redirect()->route('checkout.show', $order->id);
    }

    function cancel(Request $request)
    {
        if ($request->query('url')) {
            Http::post($request->query('url'));
        }

        $order = Order::find($request->query('orderId'));

        DB::transaction(function () use ($order) {
            $order->update([
                'order_status' => OrderStatus::CANCELED
            ]);
            $order->payment->update([
                'payment_status' => PaymentStatus::FAILED
            ]);
        });

        return response('success', 200);
    }

    function callback(Request $request)
    {
        $order = Order::where('order_number', $request->transaction_id)->first();

        if ($request->transaction_status == 'settlement') {
            DB::transaction(function () use ($order) {
                $order->update([
                    'order_status' => OrderStatus::WAITING_FOR_PICKUP
                ]);
                $order->payment->update([
                    'payment_status' => PaymentStatus::PAID
                ]);
            });
        }

        return response('success', 200);
    }
}
