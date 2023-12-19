<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\DriverStatus;

use Yajra\DataTables\DataTables;
use App\Models\Driver;

class DriverController extends Controller
{
    function index(): View
    {
        return view('admin.driver.index');
    }

    function create(): View
    {
        return view('admin.driver.create');
    }

    function getData(): JsonResponse
    {
        $brands = Driver::query();
        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $button = '<div class="btn-group pull-right">';
                $button .= '<a href="' . route('driver.show', $row->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>';
                $button .= '<button class="btn btn-sm btn-danger" id="delete" data-integrity="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->editColumn('ktp_image', function ($row) {
                return '<a href="' . asset('identity') . '/' . $row->ktp_image . '" target="_blank">Lihat KTP</a>';
            })
            ->editColumn('sim_image', function ($row) {
                return '<a href="' . asset('identity') . '/' . $row->sim_image . '" target="_blank">Lihat SIM</a>';
            })
            ->rawColumns(['action', 'ktp_image', 'sim_image'])
            ->toJson();
    }

    function store(Request $request)
    {
        $KTPFile = $request->file('ktp_image');
        $SIMFile = $request->file('sim_image');

        $KTPImage = time() . '_KTP' . $KTPFile->getClientOriginalName();
        $SIMImage = time() . '_SIM' . $SIMFile->getClientOriginalName();

        $fileLocation = 'identity';

        $customer = Driver::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'ktp_image' => $KTPImage,
            'sim_image' => $SIMImage,
            'status' => 'Active',
        ]);

        $KTPFile->move($fileLocation, $KTPImage);
        $SIMFile->move($fileLocation, $SIMImage);

        return redirect()->route('driver.index')->with('success', 'Driver berhasil ditambahkan');
    }

    function show($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    function update(Request $request, Driver $driver)
    {
        $fileLocation = 'identity';
        $KTPImage = '';
        $SIMImage = '';

        if ($request->file('ktp_image')) {
            $file = $request->file('ktp_image');
            $fileName = time() . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $KTPImage = $fileName;

            $removeImage = public_path() . "/identity/" . $driver->ktp_image;
            unlink($removeImage);
        }

        if ($request->file('sim_image')) {
            $file = $request->file('sim_image');
            $fileName = time() . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $SIMImage = $fileName;

            $removeImage = public_path() . "/identity/" . $driver->sim_image;
            unlink($removeImage);
        }

        $driver->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'ktp_image' => $KTPImage ? $KTPImage : $driver->ktp_image,
            'sim_image' => $SIMImage ? $SIMImage : $driver->sim_image,
            'status' => $request->status,
        ]);

        return redirect()->route('driver.index')->with('success', 'Data driver berhasil diubah');
    }

    function destroy($id): JsonResponse
    {
        try {
            Driver::findOrFail($id)->delete();
            return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
