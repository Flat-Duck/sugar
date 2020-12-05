@extends('doctor.layouts.app', ['page' => ''])

@section('title', 'الملف الشخصي')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل الملف الشخصي</h3>
            </div>

            <form method="post">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="name">الإسم</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="الإسم"
                            value="{{ old('name', $admin->name) }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            placeholder="البريد الإلكتروني"
                            value="{{ old('email', $admin->email) }}"
                        >
                    </div>

                    {{-- <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                            name="username"
                            class="form-control"
                            id="username"
                            placeholder="Username"
                            value="{{ old('username', $admin->username) }}"
                        >
                    </div> --}}
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">تحذيث الملف الشخصي </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Password update --}}
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل كلمة المرور</h3>
            </div>

            <form method="post" action="{{ route('doctor.password_update') }}">
                @csrf

                <div class="box-body">
                    <div class="form-group">
                        <label for="current-password">كلمة المرور الحالية</label>
                        <input type="password"
                            name="current_password"
                            class="form-control"
                            id="current-password"
                            placeholder="كلمة المرور الحالية"
                            pattern=".{6,}"
                            title="6 characters minimum"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة المرور الجديدة</label>
                        <input type="password"
                            name="password"
                            class="form-control"
                            id="password"
                            placeholder="كلمة المرور الجديدة"
                            pattern=".{6,}"
                            title="6 characters minimum"
                        >
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">تأكيد كلمة المرور</label>
                        <input type="password"
                            name="password_confirmation"
                            class="form-control"
                            id="confirm-password"
                            placeholder="تأكيد كلمة المرور"
                            pattern=".{6,}"
                            title="6 characters minimum"
                        >
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">تحديد كلمة المرور</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection