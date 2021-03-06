@extends('admin.layouts.app', ['page' => 'doctors'])

@section('title', 'doctors')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">الاطباء</h3>

                {{-- <a class="pull-right btn btn-sm btn-primary" href="{{ route('admin.doctors.create') }}">
                    إضافة جديد
                </a> --}}
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>العمليات</th>
                    </tr>

                    @forelse ($doctors as $k=> $doctor)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>
                                <form action="{{ route('admin.orders.action', ['user' => $doctor->id]) }}"method="POST"class="inline pointer">
                                    @csrf
                                    <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                                        قبول
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            
        </div>
    </div>
</div>
@endsection
