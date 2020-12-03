@extends('doctor.layouts.app', ['page' => 'appointments'])

@section('title', 'patients')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">مواعيد اليوم</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>تاريخ الميلاد</th>
                        <th>الجنس</th>
                        <th>نوع السكري</th>
                        <th>سنة الاصابة</th>
                        <th>رقم الهاتف</th>
                        <th>البريد الالكتروني</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($patients as $k=> $patient)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->birth_date }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->diabetes_type }}</td>
                            <td>{{ $patient->injury_year }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>
                                <a href="{{ route('doctor.appointments.add', ['patient' => $patient->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
{{-- 
                                <a href="{{ route('doctor.patients.edit', ['patient' => $patient->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>

                                <form action="{{ route('doctor.patients.destroy', ['patient' => $patient->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            {{-- <div class="box-footer clearfix">
                {{ $patients->links('vendor.pagination.default') }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
