@extends('layouts.app')
@section('title','طلب تحديد إجازة')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins')}}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .alert-dismissible .close{
            position: absolute;
            top: 0;
            right: 0;../../plugins
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
                    <h3 class="card-title float-none">طلب تحديد إجازة</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="{{route('leave.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <input type="hidden" id="employee_id" name="employee_id">
                                <div class="form-group">
                                    <label>إسم الموظف</label>
                                    <select id="select" class="form-control select2" style="width: 100%;">
                                        <option selected="selected" disabled>إختر أحد الموظفين</option>
                                        @forelse($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @empty
                                            <option value="">لا يوجد موظفين لعرضهم</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الوظيفة</label>
                                    <input type="text" class="form-control" id="job_title" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الرقم المدني</label>
                                    <input type="number" class="form-control" id="civil_id_number" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>القسم</label>
                                    <input type="text" class="form-control" id="department" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>الإدارة</label>
                                    <input type="text" class="form-control" id="management" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>نوع الإجازة</label>
                                    <input type="text" class="form-control" name="type" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>مدتها</label>
                                    <input type="text" class="form-control" name="duration" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>رقم النشرة</label>
                                    <input type="number" class="form-control" name="notice_number" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>تاريخها</label>
                                    <input type="date" class="form-control" name="from_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>المدة المطلوبة</label>
                                    <input type="text" class="form-control" name="required_duration" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>تبدأ من تاريخ</label>
                                    <input type="date" class="form-control" name="start_date" required>
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
    <script src="{{asset('plugins')}}/select2/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $("#select").change(function () {
                var selectedEmployeeId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{route('getEmployeeInfo','')}}" + '/'+selectedEmployeeId,
                    success: function (response) {
                        // Update the values of the fields with the received data
                        $("#employee_id") .val(response.id);
                        $("#job_title").val(response.job_title);
                        $("#civil_id_number").val(response.civil_id_number);
                        $("#department").val(response.department);
                        $("#management").val(response.management);
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>
@endsection
