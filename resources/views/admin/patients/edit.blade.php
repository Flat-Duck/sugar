@extends('admin.layouts.app', ['page' => 'patient'])

@section('title', 'patients')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border ">
            <h3 class="box-title">Edit</h3>

            <div class="box-tools pull-right">
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
            </div>

            <!-- /.box-tools -->
        </div>
        <!-- /.box-header with-border -->
        <div class="box-body">

            <form action="{{ route('admin.patients.update', $Patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header with-border">
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
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name', $Patient->name) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_date" class="col-md-3 col-form-label text-md-right">تاريخ الميلاد</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" required
                                        value="{{ old('birth_date', $Patient->birth_date) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-md-3 col-form-label text-md-right">الجنس</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="gender" name="gender" required
                                        value="{{ old('gender', $Patient->gender) }}">

                                        @if ($Patient->gender == 'male')
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                        @else
                                        @endif
                                        @if ($Patient->gender == 'female')
                                            <option value="female">female</option>
                                            <option value="male">male</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header with-border">
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
                                        value="{{ old('phone', $Patient->phone) }}" id="phone">
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">البريد الإلكتروني</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="{{ old('email', $Patient->email) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-3 col-form-label text-md-right">الحالة</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="state" name="state" required
                                        value="{{ old('state', $Patient->state) }}">

                                        @if ($Patient->state == 'active')
                                            <option>active</option>
                                            <option>unactive</option>
                                        @else
                                        @endif
                                        @if ($Patient->state == 'unactive')
                                            <option>unactive</option>
                                            <option>active</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header with-border">
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
                                <label for="injury_year" class="col-md-3 col-form-label text-md-right">سنة الإصابة</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="injury_year" required
                                        value="{{ old('injury_year', $Patient->injury_year) }}" id="injury_year">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="diabetes_type" class="col-md-3 col-form-label text-md-right">Diabetes
                                    Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="diabetes_type" name="diabetes_type" required
                                        value="{{ old('diabetes_type', $Patient->diabetes_type) }}">

                                        @if ($Patient->diabetes_type == '2')
                                            <option value='2'>type 2</option>
                                            <option value='1'>type 1</option>
                                        @else
                                        @endif
                                        @if ($Patient->diabetes_type == '1')
                                            <option value='1'>type 1</option>
                                            <option value='2'>type 2</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="doctor_id" class="col-md-3 col-form-label text-md-right">الدكتور</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="doctor_id" required id="doctor_id">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                {{ old('doctor_id', $Patient->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="box ">
                            <div class="box-header with-border">
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
                                    
                                    <input type="checkbox" name="heart_diseases" {{ $Patient->heart_diseases? 'checked':'' }} value="1"> Heart Diseases
                                    <input type="checkbox" name="hypertension" {{ $Patient->hypertension? 'checked':'' }} value="1"> Hypertension  <br>
                                    <input type="checkbox" name="bone_diseases" {{ $Patient->bone_diseases? 'checked':'' }} value="1"> Bone Diseases
                                    <input type="checkbox" name="autoimmune_disease" {{ $Patient->autoimmune_disease? 'checked':'' }} value="1"> Autoimmune Disease<br>
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


                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ route('admin.patients.index') }}" class="btn btn-default">
                    إلغاء
                </a>
            </form>
        </div>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop
