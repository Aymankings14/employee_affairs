@extends('layouts.app')
@section('title','طلب رخصة صغيرة')
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
        /*span.border-1.p-50 {*/
        /*    display: block;*/
        /*    border: 1px solid #000;*/
        /*    padding: 10px;*/
        /*    border-radius: 10px;*/
        /*    width: 50px;*/
        /*}*/

        /*label.ayman {*/
        /*    margin-left: 11px;*/
        /*}*/
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col">
            <!-- general form elements disabled -->
            <div class="card text-left">
                <div class="card-header">
                    <h3 class="card-title float-none">طلب رخصة صغيرة</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="{{route('license.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <input type="hidden" id="employee_id" name="employee_id">
                                <div class="form-group">
                                    <label>إسم الموظف</label>
                                    <select id="select" class="form-control select2" style="width: 100%;" name="select">
                                        <option selected="selected" disabled>إختر أحد الموظفين</option>
                                        @forelse($employees as $employee)
                                            <option value="{{$employee->id}}" {{(old('select')==$employee->id)? 'selected':''}}>{{$employee->name}}</option>
                                        @empty
                                            <option value="">لا يوجد موظفين لعرضهم</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>الوظيفة</label>
                                    <input type="text" class="form-control" id="job_title" disabled>
                                </div>
                            </div>
                            <div class="flex-column justify-content-center col-sm-12">
                                <div class="form-group text-center">
                                    <label class="mr-5">
                                        طبيات
                                        <span class="badge-pill badge-info d-block" id="medical">0</span>
                                    </label>
                                    <label class="mr-5">
                                        رخص
                                        <span class="badge-pill badge-success d-block" id="license">0</span>
                                    </label>
                                    <label class="mr-5">
                                        تأخير
                                        <span class="badge-pill badge-warning d-block" id="late">0</span>
                                    </label>
                                    <label class="mr-5">
                                        غياب
                                        <span class="badge-pill badge-danger d-block" id="attendees">0</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>نوعها</label>
                                    <input type="text" class="form-control" name="type" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>مدتها</label>
                                    <input type="text" class="form-control" name="time" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>السبب</label>
                                    <textarea name="reason" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>من التاريخ و الساعة</label>
                                    <input type="datetime-local" class="form-control" name="from_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>الى التاريخ و الساعة</label>
                                    <input type="datetime-local" class="form-control" name="to_date" required>
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
                        $("#license").html(response.total_approvals);
                        $("#medical ").html(response.total_medicals);
                        $("#attendees ").html(response.total_absences);
                        $("#late ").html(response.total_delays);
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>
@endsection
