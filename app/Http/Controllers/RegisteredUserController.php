<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\StatusApproval;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }

    function updateDocument(): View
    {
        return view('auth.update-document');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:20', 'unique:' . Customer::class],
            'address' => ['required', 'string', 'max:255'],
            'ktp_image' => ['required', 'image'],
            'sim_image' => ['required', 'image'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'fullname' => $request->fullname,
                'username' => Str::random(15),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Customer'
            ]);

            $KTPFile = $request->file('ktp_image');
            $SIMFile = $request->file('sim_image');

            $KTPImage = time() . '_KTP' . $KTPFile->getClientOriginalName();
            $SIMImage = time() . '_SIM' . $SIMFile->getClientOriginalName();

            $fileLocation = 'identity';

            $customer = Customer::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'ktp_image' => $KTPImage,
                'sim_image' => $SIMImage,
                'status_approval' => 'On Procces',
            ]);

            $KTPFile->move($fileLocation, $KTPImage);
            $SIMFile->move($fileLocation, $SIMImage);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil, mohon tunggu approval dokumen kamu');
    }

    public function update(Request $request, $userId): RedirectResponse
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $fileLocation = 'identity';
        $KTPImage = '';
        $SIMImage = '';

        $customer = Customer::where('user_id', $userId)->first();

        if ($request->file('ktp_image')) {
            $file = $request->file('ktp_image');
            $fileName = time() . '_KTP' . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $KTPImage = $fileName;

            $removeImage = public_path() . "/identity/" . $customer->ktp_image;
            unlink($removeImage);
        }

        if ($request->file('sim_image')) {
            $file = $request->file('sim_image');
            $fileName = time() . '_SIM' . $file->getClientOriginalName();

            $file->move($fileLocation,  $fileName);

            $SIMImage = $fileName;

            $removeImage = public_path() . "/identity/" . $customer->sim_image;
            unlink($removeImage);
        }

        $customer->update([
            'address' => $request->address,
            'status_approval' => StatusApproval::ON_PROCCESS,
            'ktp_image' => $KTPImage ? $KTPImage : $customer->ktp_image,
            'sim_image' => $SIMImage ? $SIMImage : $customer->sim_image,
        ]);

        $customer->user->update([
            'fullname' => $request->fullname
        ]);

        return redirect()->route('home')->with('success', 'Update berhasil, mohon tunggu approval dokumen kamu');
    }
}
