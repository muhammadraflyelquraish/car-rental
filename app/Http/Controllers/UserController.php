<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Models\User;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{

    public function index(): View
    {
        return view('admin.user.index');
    }

    public function create(): JsonResponse
    {
        $user = User::where('role', 'Admin')
            ->whereNotIn('id', array(auth()->user()->id));

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return parent::_getActionButton($row->id);
            })
            ->editColumn('role', function ($row) {
                return $row->role == 'Admin'
                    ? '<span class="label label-warning">' . $row->role . '</span>'
                    : '<span class="label label-primary">' . $row->role . '</span>';
            })
            ->rawColumns(['action', 'role'])
            ->toJson();
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['role'] = "Admin";
        try {
            $user = User::create($data);
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            User::findOrFail($id)->update($request->all());
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil diubah'], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_CONFLICT);
        }
    }
}
