<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Interruption;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InterruptionController extends Controller
{
    public function index(){
        $employees = Employee::select('id','name')->get();
        return view('interruption',compact('employees'));
    }
    public function store(Request $request){
        $data =$request->validate([
            'employee_id'=> 'required',
            'date'=>'required|date',
        ]);
        $interruption =new Interruption();
        $interruption->date = $data['date'];
        $interruption->employee_id = $data['employee_id'];
        if($interruption->save()) {
            Alert::success('نجاح', 'تم إضافة الإنقطاع عن العمل');
            return back();
        }
        Alert::error('حدث خطأ ما ', 'الرجاء المحاولة مرة أخرى ');
        return back();
    }
}
