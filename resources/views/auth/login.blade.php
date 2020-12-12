@extends('doctor.layouts.guest')

@section('title', 'تسجيل الدخول')

@section('content')
    <p class="login-box-msg">تسجيل الدخول</p>

    <form method="post">
        @csrf

        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني">
            <span class="fa fa-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
            <span class="fa fa-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> تذكرني
                    </label>
                </div>
            </div>

            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل دخول</button>
            </div>
        </div>
    </form>

    <a href="{{ route('password.request') }}">
       لقد نسيت كلمة المرور
    </a>
@endsection
