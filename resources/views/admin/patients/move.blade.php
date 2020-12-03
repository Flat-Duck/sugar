@extends('admin.layouts.app', ['page' => 'move'])

@section('title', 'patients')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">المرضى</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الجنس</th>
                        <th>تاريخ الميلاد</th>
                        <th>نوع السكري</th>
                        <th>سنة الاصابة</th>
                        <th>رقم الهاتف</th>
                        <th>تحويل المريض للدكتور</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($patients as $k=> $patient)
                        <form id="form-{{ $k }}" action="{{ route('admin.patient.move', ['patient' => $patient->id]) }}" method="POST"class="inline pointer">    
                            @csrf
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->gender }}</td>
                                <td>{{ $patient->birth_date }}</td>
                                <td>{{ $patient->diabetes_type }}</td>
                                <td>{{ $patient->injury_year }}</td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <select class="form-control select2" name="doctor_id">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}"  {{ old('doctor_id', $patient->doctor_id) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a style="cursor: pointer" onclick="if (confirm('Are you sure?')) { document.getElementById('form-{{ $k }}').submit(); }">
                                        تحويل
                                    </a>     
                            </td>
                        </tr>
                    </form>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="box-footer clearfix">
                {{ $patients->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
</div>
@endsection
