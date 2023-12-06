<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Employee;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends Controller
{
    public function index(){
        $employees = Employee::select('id','name')->get();
        return view('approval',compact('employees'));
    }
    public function store(Request $request){
        $data =$request->validate([
            'employee_id'=> 'required',
            'date'=>'required|date',
           'day'=>'required',
           'from_hour'=>'required|date_format:H:i',
           'to_hour'=>'required|date_format:H:i',
        ]);
        $approval =new Approval();
        $approval->employee_id = $data['employee_id'];
        $approval->date = $data['date'];
        $approval->day = $data['day'];
        $approval->from_hour = $data['from_hour'];
        $approval->to_hour = $data['to_hour'];

        if($approval->save()) {
            Alert::success('نجاح', 'تم إضافة الإستئذان');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }
}
