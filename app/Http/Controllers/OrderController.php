<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\OrderStatus;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    function index(): View
    {
        return view('admin.order.index');
    }

    function create(): JsonResponse
    {
        $orders = Order::with(['car', 'user', 'payment']);
        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $button = '<div class="btn-group pull-right">';
                $button .= '<a class="btn btn-sm btn-success" href=' . route('order.show', $row->id) . '><i class="fa fa-eye"></i></a>';
                if ($row->order_status != 'Canceled' && $row->order_status != 'On Going' && $row->order_status != 'Finished') {
                    $button .= '<button class="btn btn-sm btn-danger" id="delete" data-integrity="' . $row->id . '"><i class="fa fa-times"></i></button>';
                }
                $button .= '</div>';
                return $button;
            })
            ->editColumn('user.fullname', function ($row) {
                return '
                    <span>' . $row->user->fullname . '</span> <br>
                    <small>' . $row->user->customer->phone_number . '</small>
                ';
            })
            ->editColumn('car.name', function ($row) {
                return '
                    <span>' . $row->car->name . '</span> <br>
                    <small>' . $row->car->number_plate . '</small>
                ';
            })
            ->editColumn('start_date', function ($row) {
                return date('d M Y', strtotime($row->start_date)) . ' ~ ' . date('d M Y', strtotime($row->end_date)) . ' | ' . date('H:i', strtotime($row->pickup_time));
            })
            ->editColumn('pickup_location', function ($row) {
                if ($row->pickup_location == "") {
                    return 'Tempat Rental';
                }
                return $row->pickup_location;
            })
            ->editColumn('dropoff_location', function ($row) {
                if ($row->dropoff_location == "") {
                    return 'Tempat Rental';
                }
                return $row->dropoff_location;
            })
            ->editColumn('order_status', function ($row) {
                if ($row->order_status == 'Waiting For Payment') {
                    return '<span class="label label-secondary">' . $row->order_status . '</span>';
                } else if ($row->order_status == 'Waiting for Pickup') {
                    return '<span class="btn btn-sm btn-warning">' . $row->order_status . '</span> <button class="btn btn-sm btn-success" id="ongoing" data-url="' . route('order.ongoing', $row->id) . '"><i class="fa fa-car"></i></button>';
                } else if ($row->order_status == 'On Going') {
                    return '<span class="btn btn-sm btn-success">' . $row->order_status . '</span> <button class="btn btn-sm btn-danger" id="finish" data-url="' . route('order.finish', $row->id) . '"><i class="fa fa-car"></i></button>';
                } else if ($row->order_status == 'Finished') {
                    return '<span class="label label-primary">' . $row->order_status . '</span>';
                } else {
                    return '<span class="label label-danger">' . $row->order_status . '</span>';
                }
            })
            ->rawColumns(['action', 'user.fullname', 'car.name', 'start_date', 'order_status'])
            ->toJson();
    }

    function show(Order $order)
    {
        $order = $order
            ->load('car')
            ->load('user')
            ->load('payment');

        return view('admin.order.detail', compact('order'));
    }

    function ongoingOrder(Order $order)
    {
        $order->update([
            'order_status' => OrderStatus::ON_GOING
        ]);
    }

    function finishOrder(Order $order)
    {
        $order->update([
            'order_status' => OrderStatus::FINISHED
        ]);
    }

    function destroy(Order $order)
    {
        $order->update([
            'order_status' => OrderStatus::CANCELED
        ]);
    }

    public function export()
    {
        $time = date('dMY-His');
        return Excel::download(new OrderExport, 'order-' . $time . '.xlsx');
    }
}
