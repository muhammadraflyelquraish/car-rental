<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

use Yajra\DataTables\DataTables;
use App\Models\Customer;

class CustomerController extends Controller
{
    function index(): View
    {
        return view('admin.customer.index');
    }

    function create(): JsonResponse
    {
        $customers = Customer::with('user');
        return DataTables::of($customers)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $button = '<div class="btn-group pull-right">';
                $button .= '<a href="' . route('customer.show', $row->id) . '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>';
                $button .= '</div>';
                return $button;
            })
            ->editColumn('status_approval', function ($row) {
                if ($row->status_approval == 'On Procces') {
                    return '<span class="label label-secondary">' . $row->status_approval . '</span>';
                } else if ($row->status_approval == 'Approved') {
                    return '<span class="label label-primary">' . $row->status_approval . '</span>';
                } else if ($row->status_approval == 'Rejected') {
                    return '<span class="label label-danger">' . $row->status_approval . '</span>';
                }
            })
            ->rawColumns(['action', 'status_approval'])
            ->toJson();
    }

    function show(Customer $customer)
    {
        $customer = $customer->load('user');
        return view('admin.customer.detail', compact('customer'));
    }

    function update(Request $request, Customer $customer)
    {
        $fileLocation = 'identity';
        $KTPImage = '';
        $SIMImage = '';

        if ($request->file('ktp_image')) {
            $file = $request->file('ktp_image');
            $fileName = time() . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $KTPImage = $fileName;

            $removeImage = public_path() . "/identity/" . $customer->ktp_image;
            unlink($removeImage);
        }

        if ($request->file('sim_image')) {
            $file = $request->file('sim_image');
            $fileName = time() . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $SIMImage = $fileName;

            $removeImage = public_path() . "/identity/" . $customer->sim_image;
            unlink($removeImage);
        }

        $customer->update([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'status_approval' => $request->status_approval,
            'ktp_image' => $KTPImage ? $KTPImage : $customer->ktp_image,
            'sim_image' => $SIMImage ? $SIMImage : $customer->sim_image,
            'note' => $request->status_approval == 'Approved' ? '' : $request->note,
        ]);

        $customer->user->update([
            'fullname' => $request->fullname
        ]);

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil diubah');
    }
}
