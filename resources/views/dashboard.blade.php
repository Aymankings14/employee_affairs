@extends('layouts.app')
@section('title','الصفحة الرئيسية')
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$employeeCount}}</h3>

                    <p>عدد الموظفين</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <div  class="small-box-footer"></div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$approvalCount}}</h3>

                    <p>طلبات الإستئذان</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-checkmark-circle"></i>
                </div>
                <div class="small-box-footer"></div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$licenceCount}}</h3>

                    <p>طلبات الرخص</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard "></i>
                </div>
                <div class="small-box-footer"></div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$leaveCount}}</h3>

                    <p>الإجازات</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-exit"></i>
                </div>
                <div class="small-box-footer"></div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <section class="col-12">

            <!-- Map card -->
            <div class="card">
                <div class="card-header" style="background: #1f3b48 !important;">
                    <h3 class="card-title text-light float-left">
                        آخر موظفين تم إدخالهم
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools float-right">
                        <button type="button"
                                class="btn btn-light btn-sm"
                                data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    <table class="table table-active table-bordered table-valign-middle text-center table-hover">
                        <thead style="background: #08798b;color:#fff;">
                        <th>الإسم</th>
                        <th>الوظيفة</th>
                        </thead>
                        <tbody>
                        @forelse($lastTenEmployee as $employee)
                            <tr>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->job_title}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">لم يتم إدخال موظفين إلى الأن </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body-->
            </div>
            <!-- /.card -->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ $chart1->options['chart_title'] }}</div>

                <div class="card-body">
                    {!! $chart1->renderHtml() !!}

                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card card">
                <div class="card-header">{{ $chart2->options['chart_title'] }}</div>
                <div class="card-body">
                    {!! $chart2->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ $chart2->options['chart_title'] }}</div>
                <div class="card-body">
                    {!! $chart3->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
