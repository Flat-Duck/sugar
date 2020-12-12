@extends('doctor.layouts.guest')

@section('title', 'تأكيد الحساب')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center bold">{{ __('التحقق من صحة البريد الالكتروني') }}</h2>
<br>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('تم إرسال الرمز لبريدك الالكتروني') }}
                        </div>
                    @endif

                    {{ __('قبل الاستمرار تحقق من بريدك الالكتروني') }}
                    {{ __('إذا لم تستلم الرمز علي حسابك ') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-warning p-0 m-0 align-baseline">{{ __('إضغط هنا لطلب رمز جديد') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
