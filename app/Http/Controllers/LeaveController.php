<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
    public function index()
    {
        $employees = Employee::select('id', 'name')->get();
        return view('leave', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'type' => 'required',
            'duration' => 'required',
            'notice_number' => 'required',
            'from_date' => 'required|date',
            'required_duration' => 'required',
            'start_date' => 'required|date',
        ]);
        $leave = new Leave();
        $leave->type = $request->type;
        $leave->duration = $request->duration;
        $leave->notice_number = $request->notice_number;
        $leave->from_date = $request->from_date;
        $leave->required_duration = $request->required_duration;
        $leave->start_date = $request->start_date;
        $leave->employee_id = $request->employee_id;
        if ($leave->save()) {
            Alert::success('نجاح', 'تم إضافة الإجازة');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }
}
