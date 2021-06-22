<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Admin\ChangeAdminPasswordRequest;
use App\Models\AdminModel;


use Hash;
use Auth;

class AdminController extends Controller
{
    /**
     * redirect to admin dashboard.
     *
     *@param array
     */
    public function dashboard()
    {
        return view('admin.dashboard', ['active' => 'dashboard']);
    }

    /**
     * load view to change password.
     *
     */
    public function changePasswordView()
    {
        return view('admin.changePasswordView', ['active' => 'dashboard']);
    }

    /**
     * change password.
     *
     * @param array
     * @return true||false
     */
    public function changePassword(ChangeAdminPasswordRequest $request)
    {
        $user = Auth::guard('admin')->user();
        if (Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
            if (Hash::check($request->password, Auth::guard('admin')->user()->password)) {
                return redirect()->back()->with('error', 'Sorry, Your new Password is same as Old Password.Please choose different password');
            } else {
                $data['password'] = bcrypt($request->password);
                if ($user->update($data)) {
                    return redirect()->back()->with('message', 'Password Updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Sorry, Password can not be Changed');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Old password is not correct');
        }
    }
}
