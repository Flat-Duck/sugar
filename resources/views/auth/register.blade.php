
@extends('doctor.layouts.guest')

@section('title', 'تسجيل حساب')

@section('content')

<p class="login-box-msg"></p>

<form method="post" action="{{ route('register') }}">
    @csrf

    <div class="form-group has-feedback">
        <input type="text" name="name" class="form-control" placeholder="الاسم">
        <span class="fa fa-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني">
        <span class="fa fa-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
        <span class="fa fa-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder=" تأكيد كلمة المرور ">
        <span class="fa fa-lock form-control-feedback"></span>
    </div>

   <div class="form-group">
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل</button>
        </div>
    </div>
</form>

<a href="{{ route('login') }}">
    لدي حساب
</a>
@endsection