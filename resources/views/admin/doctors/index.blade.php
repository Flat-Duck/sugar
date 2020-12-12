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
            <div  class="box-body">
                <table id="table" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doctors as $k=> $doctor)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>
                                {{-- <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor->id]) }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a> --}}

                                <form action="{{ route('admin.doctors.activate', ['user' => $doctor->id]) }}"
                                    method="POST"
                                    class="inline pointer"
                                >
                                    @csrf
                                   
                                    <a onclick="if (confirm('Are you sure?')) { this.parentNode.submit() }">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>

            {{-- <div class="box-footer clearfix">
                {{ $doctors->links('vendor.pagination.default') }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
