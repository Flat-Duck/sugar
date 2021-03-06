<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Displays the dashboard page to the admin
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return redirect()->route('admin.orders.index');
    }

    /**
     * Displays the profile page to the admin
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $admin = Auth::user();

        return view('admin.profile', compact('admin'));
    }

    /**
     * Updates admin profile details
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate()
    {
        $validatedData = request()->validate(Admin::profileValidationRules());

        $admin = Auth::user();

        $admin->update($validatedData);

        return back()->with(['type' => 'success', 'message' => 'Profile updated successfully']);
    }

    /**
     * Updates admin password
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordUpdate()
    {
        $validatedData = request()->validate(Admin::passwordValidationRules());

        $admin = Auth::user();

        if (Hash::check(request('current_password'), $admin->password)) {
            $admin->password = bcrypt(request('password'));
            $admin->save();

            return back()->with(['type' => 'success', 'message' => 'Password updated successfully']);
        }

        return back()->with(['type' => 'error', 'message' => 'Incorrect current password']);
    }
}
