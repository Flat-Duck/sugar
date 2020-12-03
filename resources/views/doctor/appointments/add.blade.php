@extends('doctor.layouts.app', ['page' => 'appointments'])

@section('title', 'patients')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border ">
            <h3 class="box-title">Edit</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fas fa-id-box"></i> Info
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">
                            <div class="text-gray-dark text-capitalize">
                                <p>الإسم :{{ $patient->name }}</p>
                                <p>تاريخ الميلاد :{{ $patient->birth_date }}</p>
                                <p>الجنس : {{ $patient->gender }}</p>
                                <p>سنة الإصابة: {{ $patient->injury_year }}</p>
                                <p>نوع السكري : @if ($patient->diabetes_type == 1)
                                        type 1
                                    @else
                                        type 2
                                    @endif
                                </p>
                                <p>الحالة : {{ $patient->state }}</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-4">
                    <div class="box box-outline box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                التاريخ الطبي
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">
                            <div class="text-gray-dark text-capitalize ">
                                <p>
                                <h5> Other Chronic Diseases : </h5> {{ $patient->chronic_diseases }}</p>
                                <p>
                                <h5>لديه حساسية للأدوية؟ </h5> {{ $patient->Allergy_medicine }}</p>
                                <p>
                                <h5> had surgery ? </h5> {{ $patient->surgery }}</p>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                معلومات الاتصال
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">
                            <p><i class="fas fa-phone-alt"></i> phone : {{ $patient->phone }}</p>
                            <p><i class="fas fa-at"></i> البريد الإلكتروني : {{ $patient->email }}</p>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-outline box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title text-capitalize">
                                <i class="fas fa-chart-line"></i> Analyses
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">
                            <table class="table text-capitalize">
                                <thead>
                                    <tr>
                                        <td>التاريخ</td>
                                        <td>التوقيت</td>
                                        <td>الطعام</td>
                                        <td>النتيجة</td>

                                    </tr>
                                </thead>
                                @isset($analyses)

                                    @foreach ($analyses as $analysis)
                                        <tr>
                                            <td> {{ date('Y-m-d', strtotime($analysis->date_time)) }} </td>
                                            <td>{{ date('H:i', strtotime($analysis->date_time)) }}</td>
                                            <td>{{ $analysis->period }}</td>
                                            <td>{{ $analysis->glycemia }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-6">
                    <div class="box box-outline box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title text-capitalize">
                                <i class="fas fa-file-signature"></i>Advices
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">
                            <table class="table text-capitalize">
                                <thead>
                                    <tr>
                                        <td>التاريخ</td>
                                        <td>التوقيت</td>
                                        <td>الوصفة الطبية</td>
                                        <td>الدكتور</td>

                                    </tr>
                                </thead>
                                @isset($advices)
                                    @foreach ($advices as $advice)
                                        <tr>
                                            <td> {{ date('Y-m-d', strtotime($advice->created_at)) }} </td>
                                            <td>{{ date('H:i', strtotime($advice->created_at)) }}</td>
                                            <td>{{ $advice->prescription }}</td>
                                            <td>{{ $advice->doctor->name }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>

            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                               بيانات الوصفة الطبية
                            </h3>
                        </div>
                        <!-- /.box-header with-border -->
                        <div class="box-body">

                            <form action="{{ route('doctor.appointments.store',['patient'=>$patient->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="col-md-7">
                                    <label for="birth_date" class="col-form-label text-md-right">تاريخ الميلاد</label>
                                    <textarea id="prescription" name="prescription" required class="form-control">

                                    </textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="review_Date" class="col-form-label text-md-right">تاريخ الميلاد</label>
                                    <input type="date" class="form-control @error('review_Date') is-invalid @enderror"
                                        id="review_Date" name="review_Date" required value="{{ old('review_Date') }}">

                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary">
                                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-default">إلغاء</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                </div>
            </div>


        </div>

    </div>
@stop
