<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
class DoctorLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     *  load view for admin login
     *
     */
    public function loginView(){
        return view('frontend.login');
    }

    /**
     *  if user is  for admin login
     *
     */
    public function getAdminLogin(){
        if (auth()->guard('doctor')->user()){
            return redirect()->route('doctor.dashboard');
        } else {
            return view('admin.login');
        }
    }

    /**
     *  if user is for doctor login
     * @param array
     * return view
     */
    public function doctorAuth(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('doctor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('doctor.dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    /**
     *  logout admin
     * return view
     */
    public function doctorlogout(){
        Auth::guard('doctor')->logout();
        return redirect('/doctor/login');
    }
}
