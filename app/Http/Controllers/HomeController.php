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
        return view('dashboard',compact(
            'employeeCount',
            'approvalCount',
            'licenceCount',
            'leaveCount',
            'lastTenEmployee'
        ));
    }
}
