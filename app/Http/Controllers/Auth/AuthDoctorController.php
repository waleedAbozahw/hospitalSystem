<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthDoctorController extends Controller
{

    public function store(DoctorLoginRequest $request)
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::DOCTOR);
        }
        else{
            return redirect()->back()->withErrors(['name' => (trans('Dashboard/auth.failed'))]);
        }

    }

    public function destroy(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
