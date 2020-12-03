<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{

    public function index()
    {
        $doctors = User::where(['type'=>'doctor','state'=>'active'])->get();
        return view('admin.doctors.index',compact('doctors'));
    }

    public function orders()
    {
        $doctors = User::where(['type'=>'doctor','state'=>'unactive'])->get();
        return view('admin.doctors.orders',compact('doctors'));
    }

    public function action(User $user)
    {
        $user->approve();
        return redirect()->route('admin.orders.index');
    }

}
