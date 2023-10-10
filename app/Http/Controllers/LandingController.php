<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    function home()
    {
        $latestCars = Car::with('brand', 'accessories', 'images')
            ->latest()
            ->take(4)
            ->get();

        $activeOrder = "";
        if (auth()->user()) {
            $activeOrder = Order::with('car', 'user', 'payment')
                ->where('user_id', auth()->user()->id)
                ->whereIn('order_status', [
                    OrderStatus::WAITING_FOR_PAYMENT,
                    OrderStatus::ON_GOING,
                    OrderStatus::WAITING_FOR_PICKUP
                ])
                ->latest()
                ->first();
        }
        return view('landing.home', compact('latestCars', 'activeOrder'));
    }

    function aboutUs()
    {
        return view('landing.about-us');
    }

    function listCars()
    {
        $cars = Car::orderBy('created_at', 'desc')
            ->with('brand', 'images', 'accessories')
            ->paginate(12);

        return view('landing.list-cars', compact('cars'));
    }

    function carDetail($carId)
    {
        $car = Car::find($carId)
            ->load('brand')
            ->load('images')
            ->load('accessories');

        $payment_methods = PaymentMethod::get();

        return view('landing.car-details', compact('car', 'payment_methods'));
    }

    function contactUs()
    {
        return view('landing.contact-us');
    }

    function getImage(Request $request)
    {
        $imageData = file_get_contents($request->query('url'));
        return response($imageData, 200)->header('Content-Type', 'image/jpeg');
    }
}
