@extends('layouts.app')
@section('title','إنشاء موظف')
@section('css')
    <style>
        .alert-dismissible .close{
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
            left:unset;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col">
            <!-- general form elements disabled -->
            <div class="card text-left">
                <div class="card-header">
                    <h3 class="card-title float-none">إدخال موظف جديد</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="{{route('employee.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>إسم الموظف</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>المسمى الوظيفي</label>
                                    <input type="text" class="form-control" name="job_title" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>رقم هوية العمل</label>
                                    <input type="number" class="form-control" name="work_id_number" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الرقم المدني</label>
                                    <input type="number" class="form-control" name="civil_id_number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>تاريخ التعيين</label>
                                    <input type="date" class="form-control" name="appointment_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>القسم</label>
                                    <input type="text" class="form-control" name="department" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الإدارة</label>
                                    <input type="text" class="form-control" name="management" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">حفظ</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
@section('js')

@endsection
