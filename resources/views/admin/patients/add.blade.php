@extends('admin.layouts.app', ['page' => 'patient'])

@section('title', 'patients')

@section('content')
    <div class="box ">
        <div class="box-header with-border">
            <h3 class="box-title">إضافة مريض جديد</h3>

            <div class="box-tools">

            </div>

            <!-- /.box-tools -->
        </div>
        <!-- /.box-header  with-border -->
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Warning!</strong> Please check input field code<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.patients.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header  with-border">
                                <h3 class="box-title">معلومات شخصية</h3>
                            </div>
                            <div class="box-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <br />
                            </div>
                            <div class="box-body">
                            <div class="form-group row ">
                                <label for="name" class="col-md-3 col-form-label text-md-right">الإسم</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_date" class="col-md-3 col-form-label text-md-right">تاريخ الميلاد</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                        id="birth_date" name="birth_date" required value="{{ old('birth_date') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-md-3 col-form-label text-md-right">الجنس</label>
                                <div class="col-md-8">
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" required value="{{ old('gender') }}">
                                        <option value="male">male</option>
                                        <option value="female">female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header  with-border">
                                <h3 class="box-title">معلومات الاتصال</h3>
                            </div>
                            <div class="box-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <br />
                            </div>
                            <div class="box-body">
                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">رقم الهاتف</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone" required placeholder="رقم الهاتف"
                                        value="{{ old('phone') }}" id="phone">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">البريد الإلكتروني</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-3 col-form-label text-md-right">الحالة</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="state" name="state" required
                                        value="{{ old('state') }}">
                                        <option>active</option>
                                        <option>unactive</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header  with-border">
                                <h3 class="box-title">
                                    معلومات طبية
                                </h3>
                            </div>
                            <div class="box-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <br />
                            </div>
                            <div class="box-body">
                            <div class="form-group row">
                                <label for="injury_year" class="col-md-4 col-form-label text-md-right">سنة الإصابة</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="injury_year" required
                                        value="{{ old('injury_year') }}" id="injury_year">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="diabetes_type" class="col-md-4 col-form-label text-md-right">Diabetes
                                    Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="diabetes_type" name="diabetes_type" required
                                        value="{{ old('diabetes_type') }}">
                                        <option value='1'>type 1</option>
                                        <option value='2'>type 2</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-header  with-border">
                                <h3 class="box-title">
                                    التاريخ الطبي
                                </h3>
                            </div>
                            <div class="box-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <br />
                            </div>
                            <div class="box-body">
                            <div class="form-group row">
                                <label for="diabetes_type" class="col-md-5 col-form-label text-md-right"> other Chronic
                                    Diseases ?</label>
                                <div class="col-md-6">
                        
                                    <input type="checkbox" name="heart_diseases" value="1"> Heart Diseases
                                    <input type="checkbox" name="hypertension" value="1"> Hypertension  <br>
                                    <input type="checkbox" name="bone_diseases" value="1"> Bone Diseases
                                    <input type="checkbox" name="autoimmune_disease" value="1"> Autoimmune Disease<br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-form-label text-md-right">لديه حساسية للأدوية؟</label>
                                <div class="col-md-6">
                                    <div class="col-md-18">
                                        <input type="text" class="form-control" id="Allergy_medicine"
                                            name="Allergy_medicine" placeholder="Yes or No and Details"
                                            value="{{ old('D_Allergy_medicine') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-form-label text-md-right">هل قام بعملية جراحية؟</label>
                                <div class="col-md-6">
                                    <div class="col-md-18">
                                        <input type="text" class="form-control" id="surgery" name="surgery"
                                            placeholder="Yes or No and Details" value="{{ old('surgery') }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    معلومات الاتصال
                                </h3>
                            </div>
                            <!-- /.box-header with-border -->
                            <div class="box-body">
                                <div class="col-md-8">
                                    <label for="birth_date" class="col-form-label text-md-right">الوصفة الطبية </label>
                                    <textarea id="prescription" name="prescription"  required class="form-control">
    
                                    </textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="review_Date" class="col-form-label text-md-right">تاريخ المراجعة</label>
                                    <input type="date" class="form-control @error('review_Date') is-invalid @enderror"
                                        id="review_Date" name="review_Date" required value="{{ old('review_Date') }}">
    
                                </div>
                                
                            </div>
                            <!-- /.box-body -->
    
                        </div>
                        <!-- /.box -->
    
                    </div>
                </div>
                <input type="hidden" name="doctor_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('admin.patients.index') }}" class="btn btn-default">
                    إلغاء
                </a>
            </form>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop
