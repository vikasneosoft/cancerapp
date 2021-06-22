<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     *  load view for admin login
     *
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     *  if user is  for admin login
     *
     */
    public function getAdminLogin()
    {
        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin_dashboard');
        } else {
            return view('admin.login');
        }
    }

    /**
     *  if user is  for admin login
     * @param array
     * return view
     */
    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    /**
     *  logout admin
     * return view
     */
    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
