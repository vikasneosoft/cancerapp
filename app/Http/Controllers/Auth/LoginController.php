<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\LoginRequest;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function patientLogin(LoginRequest $request)
    {
        $inputs = $request->all();
        $auth = Auth::attempt(
            [
                'email'  => $request->get('email'),
                'password'  => $request->get('password')
            ]
        );
        if ($auth) {
            $status = 1;
        } else {
            $status = 2;
        }
        return response()->json($status);
    }
}
