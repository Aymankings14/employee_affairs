@extends('layouts.app')
@section('title','بيانات الموظفين ')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection
@section('content')
<div class="row">
        <div class="col-12">
            <div class="card text-left">
                <div class="card-header">
                    <h3 class="card-title float-left">بيانات الموظفين</h3>
                    <h3 class="float-right"><a href="{{route('employee.create')}}" class="btn btn-outline-primary">إدخال موظف</a></h3>
                    <div class="clearfix"></div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>الإسم </th>
                            <th>المسمى الوظيفي</th>
                            <th>رقم هوية العمل </th>
                            <th>الرقم المدني</th>
                            <th>رقم الهاتف</th>
                            <th>تاريخ التعيين</th>
                            <th>القسم</th>
                            <th>الإدارة</th>
                            <th>إجراء</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->job_title}}</td>
                                <td>{{$employee->work_id_number}}</td>
                                <td>{{$employee->civil_id_number}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->appointment_date}}</td>
                                <td>{{$employee->department}}</td>
                                <td>{{$employee->management}}</td>
                                <td>
                                    <a href="{{route('employee.destroy',$employee->id)}}" data-confirm-delete="true"><i class="fa fa-trash-alt text-danger"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-bold">لا يوجد موظفين في النظام برجاء إدخال المزيد</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
@section('js')
    <!-- DataTables -->
    <script src="{{asset('plugins')}}/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/ar.json',
                },
            });
        });
    </script>
@endsection
