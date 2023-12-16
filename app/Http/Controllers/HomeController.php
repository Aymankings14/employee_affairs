<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Employee;
use App\Models\Interruption;
use App\Models\Leave;
use App\Models\License;
use App\Models\Medical;
use App\Models\Punishment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $employeeCount = Employee::Count();
        $approvalCount = Approval::Count();
        $licenceCount = License::Count();
        $leaveCount = Leave::Count();
        $lastTenLicenses = License::with('employee')->limit(10)->orderBy('id', 'DESC')->get();
        $lastTenEmployee=Employee::limit(10)->orderBy('id', 'DESC')->get();
        $chart_options = [
            'chart_title' => 'رسم بياني لإجازات الموظفين',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Leave',
            'relationship_name'=>'employee',
            'group_by_field' => 'name',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => '0,123,255',
            'aggregate_function' => 'count',
            'group_by_field_format' => 'Y-m-d H:i:s',
//            'aggregate_field' => 'month(from_date a)',
        ];
        $chart1 = new LaravelChart($chart_options);
        $chart_options2 = [
            'chart_title' => 'رسم بياني عن التقارير الطبية',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Medical',
            'relationship_name'=>'employee',
            'group_by_field' => 'name',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => '0,123,255'

        ];
        $chart2 = new LaravelChart($chart_options2);
        $chart_options3 = [
            'chart_title' => 'رسم بياني عن إنقطاع الموظفين عن العمل',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Interruption',
            'relationship_name'=>'employee',
            'group_by_field' => 'name',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'aggregate_function' => 'count',
            'aggregate_field' => 'month(date)',
            'chart_color' => '0,123,255'
        ];
        $chart3 = new LaravelChart($chart_options3);
        return view('dashboard',compact([
            'employeeCount',
            'approvalCount',
            'licenceCount',
            'leaveCount',
            'lastTenEmployee',
            'chart1',
            'chart2',
            'chart3',
        ]));
    }
}
