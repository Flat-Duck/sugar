@extends('admin.layouts.app', ['page' => 'patient'])

@section('title', 'patients')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border ">
            <h3 class="box-title">الملف الشخصي</h3>
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
                                <p >الإسم : <b>{{ $Patient->name }}</b></p>
                                <p >تاريخ الميلاد :<b>{{ $Patient->birth_date }}</b></p>
                                <p >الجنس : <b>{{ $Patient->gender }}</b></p>
                                <p >سنة الإصابة: <b>{{ $Patient->injury_year }}</b></p>
                                <p >نوع السكري :  <b>{{ $Patient->diabetes_type == 1? 'Type 1': 'Type 2'}}</b></p>
                                <p >الحالة : <b>{{ $Patient->state }}</b></p>
                                <p >الدكتور : <b>{{ $Patient->doctor['name'] }}</b></p>
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
                                <h5> Other Chronic Diseases : </h5> 
                                <b><p >{{ $Patient->heart_diseases? 'Heart Diseases':'' }}</p></b>
                                <b><p >{{ $Patient->hypertension? 'Hypertension':'' }}</p></b>
                                <b> <p >{{ $Patient->bone_diseases? 'Bone Diseases':'' }}</p></b>
                                    <b><p >{{ $Patient->autoimmune_disease? 'Autoimmune Diseases':'' }}</p></b>
                                <p >
                                <h5>لديه حساسية للأدوية؟ </h5> <b>{{ $Patient->Allergy_medicine }}</b></p>
                                <p >
                                <h5> had surgery ? </h5><b> {{ $Patient->surgery }}</b></p>

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
                            <p ></i> phone : <b>{{ $Patient->phone }}</b></p>
                            <p ></i> البريد الإلكتروني : <b>{{ $Patient->email }}</b></p>
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

                                    @foreach ($analyses as $Analysis)
                                        <tr>
                                            <td> {{ date('Y-m-d', strtotime($Analysis->date_time)) }} </td>
                                            <td>{{ date('H:i', strtotime($Analysis->date_time)) }}</td>
                                            <td>{{ $Analysis->period }}</td>
                                            <td>{{ $Analysis->glycemia }}</td>
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
                                @isset($Advices)
                                    @foreach ($Advices as $Advice)
                                        <tr>
                                            <td> {{ date('Y-m-d', strtotime($Advice->created_at)) }} </td>
                                            <td>{{ date('H:i', strtotime($Advice->created_at)) }}</td>
                                            <td>{{ $Advice->prescription }}</td>
                                            <td>{{ $Advice->doctor->name }}</td>
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


        </div>

    </div>
@stop
