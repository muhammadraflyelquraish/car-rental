<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAccessories;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;


class CarController extends Controller
{
    function index()
    {
        return view('admin.car.index');
    }

    function data()
    {
        $cars = Car::with('brand', 'accessories', 'images');
        return DataTables::of($cars)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $button = '<div class="btn-group pull-right">';
                $button .= '<a href="' . route('car.edit', $row->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>';
                $button .= '<button class="btn btn-sm btn-danger" id="delete" data-integrity="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->editColumn('name', function ($row) {
                return $row->brand->name . '&nbsp;' . $row->name;
            })
            ->editColumn('mileage', function ($row) {
                return number_format($row->mileage, 0) . '&nbsp;KM';
            })
            ->editColumn('price_per_day', function ($row) {
                return 'Rp&nbsp;' . number_format($row->price_per_day, 0);
            })
            ->rawColumns(['action', 'name', 'mileage', 'price_per_day'])
            ->toJson();
    }

    function create()
    {
        $brands = Brand::pluck('name', 'id');
        return view('admin.car.create', compact('brands'));
    }

    function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $car = Car::create([
                'name' => $request->name,
                'number_plate' => $request->number_plate,
                'brand_id' => $request->brand_id,
                'launch_year' => $request->launch_year,
                'mileage' => $request->mileage,
                'transmission' => $request->transmission,
                'fuel_type' => $request->fuel_type,
                'number_of_seat' => $request->number_of_seat,
                'price_per_day' => $request->price_per_day,
                'description' => $request->description,
            ]);

            $accessories = [];
            foreach ($request->accessories_name as $i => $value) {
                array_push($accessories, [
                    'car_id' => $car->id,
                    'name' => $value,
                    'is_featured' => $request->accessories_value[$i],
                    'created_at' => now(),
                ]);
            }

            CarAccessories::insert($accessories);

            $cars = [];
            foreach ($request->file('images') as $i => $file) {
                if ($value) {
                    $fileName = time() . $file->getClientOriginalName();
                    $fileLocation = 'cars';
                    $file->move($fileLocation,  $fileName);

                    array_push($cars, [
                        'car_id' => $car->id,
                        'url' => $fileName,
                        'sequence' => $i + 1,
                        'created_at' => now(),
                    ]);
                }
            }

            CarImage::insert($cars);
        });

        return redirect()->route('car.index')->with('success', 'Data mobil berhasil dibuat');
    }

    function edit(Car $car)
    {
        $car->load('brand')
            ->load('accessories')
            ->load('images');
        $brands = Brand::pluck('name', 'id');
        return view('admin.car.edit', compact('car', 'brands'));
    }

    function update(Request $request, Car $car)
    {
        DB::transaction(function () use ($request, $car) {
            $car->update([
                'name' => $request->name,
                'number_plate' => $request->number_plate,
                'brand_id' => $request->brand_id,
                'launch_year' => $request->launch_year,
                'mileage' => $request->mileage,
                'transmission' => $request->transmission,
                'fuel_type' => $request->fuel_type,
                'number_of_seat' => $request->number_of_seat,
                'price_per_day' => $request->price_per_day,
                'description' => $request->description,
            ]);

            foreach ($request->accessories_name as $i => $value) {
                CarAccessories::where('car_id', $car->id)
                    ->where('name', $value)
                    ->update(['is_featured' => $request->accessories_value[$i]]);
            }
            if ($request->images) {
                foreach ($request->file('images') as $i => $file) {
                    if ($value) {
                        $lastImage = CarImage::where('car_id', $car->id)->latest()->first();
                        $isReplaceImage = CarImage::where('car_id', $car->id)->skip($i)->first();

                        $fileName = time() . $file->getClientOriginalName();
                        $fileLocation = 'cars';

                        if ($isReplaceImage) {
                            $removeImage = public_path() . "/cars/" . $isReplaceImage->url;

                            $isReplaceImage->update([
                                'url' => $fileName,
                                'updated_at' => now()
                            ]);

                            $file->move($fileLocation,  $fileName);
                            unlink($removeImage);
                        } else {
                            CarImage::create([
                                'car_id' => $car->id,
                                'url' => $fileName,
                                'sequence' => $lastImage ? $lastImage->sequence + 1 : 1,
                                'created_at' => now(),
                            ]);
                            $file->move($fileLocation,  $fileName);
                        }
                    }
                }
            }
        });

        return redirect()->route('car.index')->with('success', 'Data mobil berhasil diubah');
    }

    function destroy(Car $car)
    {
        DB::transaction(function () use ($car) {
            foreach ($car->images as $image) {
                $removeImage = public_path() . "/cars/" . $image->url;
                unlink($removeImage);
            }

            $car->accessories()->delete();
            $car->images()->delete();
            $car->delete();
        });

        return response()->json([
            'res' => 'success'
        ], Response::HTTP_NO_CONTENT);
    }
}
